<?php

namespace Irishdash\StorageBundle\Controller;

use Irishdash\StorageBundle\Entity\MainForm;
use Irishdash\StorageBundle\Entity\Storage;
use Irishdash\StorageBundle\Form\MainFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * Home action
     * Renders form and handles POST action
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function homeAction()
    {
        $mainForm = new MainForm();
        $form = $this->createForm(new MainFormType(), $mainForm);

        $request = Request::createFromGlobals();
        if ($request->getMethod() == 'POST') {
            $form->submit($request);

            if ($form->isValid()) {

                // Persist data to database
                $storage = new Storage();
                $randomCode = $this->generateCode();

                $storage->setName($mainForm->getName());
                $storage->setSource($mainForm->getSource());
                $storage->setType($mainForm->getType());
                $storage->setCode($randomCode);

                $em = $this->getDoctrine()->getManager();
                $em->persist($storage);
                $em->flush();

                // Generating link to source
                $this->get('session')->getFlashBag()->add(
                    'blogger-notice',
                    $this->container->get('router')->getContext()->getBaseUrl() . "/source/" . $randomCode
                );

                // Render main form
                return $this->render('IrishdashStorageBundle:Default:index.html.twig', array(
                        'form' => $form->createView(),
                        'mainForm' => $mainForm
                    ));
            }
        }

        return $this->render('IrishdashStorageBundle:Default:index.html.twig', array(
                'form' => $form->createView(),
                'mainForm' => $mainForm
            ));
    }

    /**
     * Show saved source
     *
     * @param string $code
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function showAction($code)
    {
        $em = $this->getDoctrine()->getManager();

        $storage = $em->getRepository('IrishdashStorageBundle:Storage')->findByCode($code);

        if (!$storage) {
            throw $this->createNotFoundException("Can't find source.");
        }

        return $this->render('IrishdashStorageBundle:Storage:show.html.twig', array(
                'storage'  => $storage[0],
            ));
    }

    /**
     * Generate random code
     *
     * @param int $length
     * @return string
     */
    protected function generateCode($length = 6) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);

        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }

        return $result;
    }

}
