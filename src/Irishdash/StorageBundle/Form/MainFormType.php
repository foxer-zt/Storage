<?php
/**
 * Created by PhpStorm.
 * User: irishdash
 * Date: 23.10.14
 * Time: 22:35
 */

namespace Irishdash\StorageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class MainFormType
 * Class handler for home page main form
 *
 * @package Irishdash\StorageBundle\Form
 */
class MainFormType extends AbstractType
{
    /**
     * Choices for source type dropdown
     *
     * @var array
     */
    protected $choices = array(
        'choices' => array(
            'text' => 'Text',
            'php' => 'PHP',
            'python' => 'Python',
            'java' => 'JAVA',
            'javascript' => 'JavaScript',
            'c' => 'C'
        )
    );

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', null, array('label' => false));
        $builder->add('source', 'textarea', array('label' => false));
        $builder->add('type', 'choice', $this->choices);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'mainForm';
    }
} 