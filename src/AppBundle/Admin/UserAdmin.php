<?php
// src/Acme/DemoBundle/Admin/PostAdmin.php

namespace AppBundle\Admin;

use AppBundle\Entity\User;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;


class UserAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $isNew = null === $this->getSubject()->getId() ? true : false;

        $formMapper
            ->add('lastName')
            ->add('firstName')
            ->add('birthday', 'birthday', [
                'years' => range(date('Y')-90, date('Y')),
            ])
            ->add('gender', 'choice', [
                'choices' => [
                    User::GENDER_MALE   => 'Male',
                    User::GENDER_FEMALE => 'Female',
                ],
                'data' => true === $isNew ? User::GENDER_FEMALE : $this->getSubject()->getGender(),
            ])
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('lastName')
            ->add('firstName')
            ->add('gender', null, [], 'choice', [
                'choices' => [
                    User::GENDER_MALE   => 'Male',
                    User::GENDER_FEMALE => 'Female',
                ],
            ])
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('lastName')
            ->add('firstName')
            ->add('gender', 'choice', [
                'choices' => [
                    User::GENDER_MALE   => 'Male',
                    User::GENDER_FEMALE => 'Female',
                ],
            ])
            ->add('birthday')
            ->add('_action', 'actions', [
                'actions' => [
                    'edit' => [],
                    'show' => [],
                    'delete' => [],
                ],
            ])
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        // Here we set the fields of the ShowMapper variable, $showMapper (but this can be called anything)
        $showMapper
            ->add('id')
            ->add('name')
            ->add('releasedAt')
            ->add('picture')
            ->add('summary')
            ->add('country')
        ;

    }
}