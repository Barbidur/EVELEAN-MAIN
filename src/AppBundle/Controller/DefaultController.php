<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Customer;
use AppBundle\Entity\CustomerInfo;
use AppBundle\Entity\User;

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
            $leadpages_target = $request->get('leadpages_target');

            $customer_info->setCustomerInfoBusinessType($business_type);
            $customer_info->setCustomerInfoIndustry($industry);
            $customer_info->setCustomerInfoHasDomain($own_domain);
            $customer_info->setCustomerInfoFacebookAdsExpenditure($facebook_ads_expenditure);
            $customer_info->setCustomerInfoLeadpagesTarget($leadpages_target);
            $date = new \DateTime();
            $customer_info->setCreateDt($date);
            $customer_info->setUpdateDt($date);
            $customer_info->setCustomer($customer);

            $em->persist($customer_info);
            $em->flush();

            return $this->redirectToRoute('subdomainpage', array('id' => $customer_info->getCustomerInfoId()));
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

        if ($request->getMethod() == 'POST') {
            $subdomain = $request->get('subdomain');
            $subdomain = "https://".$subdomain.".evelean.com";
            $customer_info->setCustomerInfoDomain($subdomain);

            $em->persist($customer_info);
            $em->flush();
        }
        return $this->render('default/subdomain.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
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
}
