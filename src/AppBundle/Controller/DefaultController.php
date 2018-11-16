<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Filesystem\Filesystem;
use AppBundle\Entity\Customer;
use AppBundle\Entity\CustomerInfo;
use AppBundle\Entity\User;
use AppBundle\Entity\CreditCard;
use AppBundle\Entity\Instance;
use Aws\Ec2\Ec2Client;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $customer = new Customer();
        $em = $this->getDoctrine()->getManager();
            
        if ($request->getMethod() == 'POST') {
            $first_name = $request->get('first_name');
            $last_name = $request->get('last_name');
            $country = $request->get('country');
            $email = $request->get('email');
            $password = $request->get('password');
            $belong_to_group = $request->get('belong_to_group');
            $owner_tag = $request->get('owner_tag');
            if ($owner_tag == null || $owner_tag == '') {
                $owner_tag = "none";
            }
            $receive_updates = $request->get('receive_updates');
            $receive_updates = $request->get('receive_updates');

            $customer->setCustomerFname($first_name);
            $customer->setCustomerLname($last_name);
            $customer->setCustomerCountry($country);
            $customer->setCustomerCompany($owner_tag);
            $customer->setCustomerEmail($email);
            if ($receive_updates == "on") {
                $customer->setCustomerReceiveUpdate(1);
            } else {
                $customer->setCustomerReceiveUpdate(0);
            }
            
            if ($belong_to_group == "on") {
                $customer->setCustomerBelongToGroup(1);
            } else {
                $customer->setCustomerBelongToGroup(0);
            }

            $date = new \DateTime();
            $customer->setCreateDt($date);
            $customer->setUpdateDt($date);

            $em->persist($customer);
            $em->flush();

            $user = new User();
            $user->setUserLogin($email);
            $user->setUserPassword(md5($password));
            $user->setCreateDt($date);
            $user->setUpdateDt($date);
            $user->setCustomer($customer);

            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('detailspage', array('id' => $customer->getCustomerId()));
        }
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/{id}/additional-details", name="detailspage")
     * @Method({"GET", "POST"})
     */
    public function detailsAction(Request $request, Customer $customer)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() == 'POST') {
            $customer_info = new CustomerInfo();

            $business_type = $request->get('business_type');
            $industry = $request->get('industry');
            $own_domain = $request->get('own_domain');
            $facebook_ads_expenditure = $request->get('facebook_ads_expenditure');
            $leadpages_target = $request->get('evelean_target');

            if ($own_domain == "Yes") {
                $own_domain = 1;
            } else {
                $own_domain = 0;
            }

            $customer_info->setCustomerInfoBusinessType($business_type);
            $customer_info->setCustomerInfoIndustry($industry);
            $customer_info->setCustomerInfoHasDomain($own_domain);
            $customer_info->setCustomerInfoFacebookAdsExpenditure($facebook_ads_expenditure);
            $customer_info->setCustomerInfoLeadpagesTarget($leadpages_target);
            $subdomain = 'https://subdomain.evelean.com';
            $customer_info->setCustomerInfoDomain($subdomain);
            $date = new \DateTime();
            $customer_info->setCreateDt($date);
            $customer_info->setUpdateDt($date);
            $customer_info->setCustomer($customer);

            $em->persist($customer_info);
            $em->flush();

            return $this->redirectToRoute('subdomainpage', array('id' => $customer_info->getCustomerInfoId(), 'customer_info' => $customer_info));
        }

        return $this->render('default/details.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'customer' => $customer
        ]);
    }

    /**
     * @Route("/{id}/subdomain", name="subdomainpage")
     * @Method({"GET", "POST"})
     */
    public function subdomainAction(Request $request, CustomerInfo $customer_info)
    {
        $em = $this->getDoctrine()->getManager();

        
        return $this->render('default/subdomain.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'customer_info' => $customer_info
        ]);
    }

    /**
     * @Route("/checkemail", name="checkemail")
     * @Method({"GET", "POST"})
     */
    public function checkemailAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $validation = 'success';

        if($request->isXmlHttpRequest()) { 
            if ($request->getMethod() == 'POST') {
                $email = $request->get('email');
                $customer = $em->getRepository('AppBundle:Customer')->findBy(array('customerEmail' => $email));

                if(count($customer) > 0) {
                    $validation = 'invalid';
                } else {
                    $validation = 'success';
                }

                $response = new JsonResponse();
                $response->setData(array(
                    'data' => $validation
                ));
                return $response;
            }
        } else {
            throw new \Exception("You are not authorised to perform this action");
        }
    }

    /**
     * @Route("/customers", name="listcustomerpage")
     * @Method({"GET", "POST"})
     */
    public function listcustomerAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $customers = $em->getRepository('AppBundle:Customer')->findAll();

        return $this->render('default/customer_info.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'customers' => $customers
        ]);
    }

    /**
     * @Route("/savesubdomain", name="save_subdomain")
     * @Method({"GET", "POST"})
     */
    public function savesubdomainAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $validation = 'success';

        if($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager(); 
            $subdomain = $request->get('subdomain');
            $customer_info_id = $request->get('customer_info_id');
            $customer_info = $em->getRepository('AppBundle:CustomerInfo')->find($customer_info_id);
            $subdomain = "https://".$subdomain.".evelean.com";
            $customer_info->setCustomerInfoDomain($subdomain);
            $date = new \DateTime();
            $customer_info->setUpdateDt($date);

            try {
                $em->persist($customer_info);
                $em->flush();
                $validation = 'success';
            } catch(Exception $e) {
                $validation = $e->getMessage();
            }

            $response = new JsonResponse();
            $response->setData(array(
                'data' => $validation
            ));
            return $response;

        } else {
            throw new \Exception("You are not authorised to perform this action");
        }
    }

    /**
     * @Route("/{id}/checkout", name="checkout")
     * @Method({"GET", "POST"})
     */
    public function checkoutAction(Request $request, CustomerInfo $customer_info)
    {
        if ($request->getMethod() == 'POST') {

            \Stripe\Stripe::setApiKey($this->getParameter('stripe_secret_key'));

            // Get the credit card details submitted by the form
            $token = $_POST['stripeToken'];
            $stripeEmail = $_POST['stripeEmail'];

            $charge_amt = 50;

            $str_charge = $charge."00";
            $stipe_charge = (int)$str_charge;

            $customer = \Stripe\Customer::create(array(
                  'email' => $stripeEmail,
                  'card'  => $token
            ));

            $charge = \Stripe\Charge::create(array(
                  'customer' => $customer->id,
                  'amount'   => $stipe_charge,
                  'currency' => 'usd',
                  "description" => "Paiement Stripe - Fujaco"
            ));

            $em = $this->getDoctrine()->getManager();

            $customer_model = $customer_info->getCustomer();

            $creditCard = new CreditCard();
            $creditCard->setCreditCardStripeToken($customer->id);
            $date = new \DateTime();
            $creditCard->setCreateDt($date);
            $creditCard->setUpdateDt($date);
            $creditCard->setCustomer($customer_model);

            $em->persist($creditCard);
            $em->flush();

            $customer_model = $customer_info->getCustomer();
            $cust_id = $customer_model->getCustomerId();

            $ec2Client = Ec2Client::factory(array(
                'key'    => $this->getParameter('aws_key'),
                'secret' => $this->getParameter('aws_secret'),
                'region' => 'eu-west-3', // (e.g., us-east-1)
                'version' => '2016-11-15',
                'credentials' => array(
                    'key'    => $this->getParameter('aws_key'),
                    'secret' => $this->getParameter('aws_secret')
                )
            ));

            $keyPairName = 'my-keypair'.$cust_id;
            $keypair = $ec2Client->createKeyPair(array(
                'KeyName' => $keyPairName
            ));

            $keypair = $keypair->toArray();
            //print_r($keypair); die();

            $base_path = $this->get('kernel')->getProjectDir();
            // Save the private key

            if( !is_dir($base_path.'\web/\/'.$cust_id)) {
                mkdir($base_path.'\web/\/'.$cust_id, 0777, true);
            }

            $saveKeyLocation = $base_path. '\web/\/'.$cust_id. '/\/'. $keyPairName .".pem";
            $keyloc = $cust_id."/{$keyPairName}.pem";
            file_put_contents($saveKeyLocation, $keypair['KeyMaterial']);

            // Update the key's permissions so it can be used with SSH
            chmod($saveKeyLocation, 0600);

            // Create the security group
            $securityGroupName = 'my-security-group'.$cust_id;
            $securityGroup = $ec2Client->createSecurityGroup(array(
                'GroupName'   => $securityGroupName,
                'Description' => 'Basic web server security'
            ));

            // Get the security group ID (optional)
            $securityGroupId = $securityGroup->get('GroupId');

            // Set ingress rules for the security group
            $ec2Client->authorizeSecurityGroupIngress(array(
                'GroupName'     => $securityGroupName,
                'IpPermissions' => array(
                    array(
                        'IpProtocol' => 'tcp',
                        'FromPort'   => 80,
                        'ToPort'     => 80,
                        'IpRanges'   => array(
                            array('CidrIp' => '0.0.0.0/0')
                        ),
                    ),
                    array(
                        'IpProtocol' => 'tcp',
                        'FromPort'   => 22,
                        'ToPort'     => 22,
                        'IpRanges'   => array(
                            array('CidrIp' => '0.0.0.0/0')
                        ),
                    )
                )
            ));

            $instance_name = str_replace('.evelean.com', '', $customer_info->getCustomerInfoDomain());
            $instance_name = str_replace('https://', '', $instance_name);

            // Launch an instance with the key pair and security group
            $instance = $ec2Client->runInstances(array(
                'ImageId'        => 'ami-08182c55a1c188dee', //change this to required AMI
                'MinCount'       => 1,
                'MaxCount'       => 1,
                'InstanceType'   => 't2.micro',
                'KeyName'        => $keyPairName,
                'SecurityGroups' => array($securityGroupName)
            ));

            $instance = $instance->toArray();

            $instanceId = $instance['Instances'][0]['InstanceId']; //get array of Instances

            $tag = $ec2Client->createTags(array(
                'Resources' => array($instanceId),
                'Tags' => array(
                    array(
                        'Key' => 'Name',
                        'Value' => $instance_name
                    )
                )
            ));

            $instance_model = new Instance();
            $instance_model->setInstanceAwsId($instanceId);
            $instance_model->setInstanceAwsName($instance_name);
            $instance_model->setCreateDt($date);
            $instance_model->setUpdateDt($date);
            $instance_model->setCustomer($customer_model);

            $em->persist($instance_model);
            $em->flush();

            return $this->render('default/summary.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
                'customer' => $customer_model,
                'customer_info' => $customer_info,
                'charge' => $charge_amt,
                'saveKeyLocation' => $keyloc,
                'instance' => $instance_model,
            ]);
        }
        return $this->render('default/summary.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}