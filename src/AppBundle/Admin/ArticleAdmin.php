<?php
namespace AppBundle\Admin;

//use AppBundle\Form\GenreType;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ArticleAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', null, [
                'attr' => [
                    'class'    => 'custom-text',
                    'data-url' => 'https://google.com',
                ],
            ])
            ->add('categories')
            ->add('tags')
            ->add('content')
            ->add('user')
            ->add('picture')


        ;
    }
    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('content')
            ->add('picture')
            ->add('categories')
            ->add('user')


        ;
    }
    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('name')
            ->add('categories')
            ->add('tags')
            ->add('content')
            ->add('picture')
            ->add('user')

            ->add('_action', 'actions', [
                'actions' => [
                    'show'   => [],
                    'edit'   => [],
                    'delete' => [],
                ],
            ])
        ;
    }
    // Fields to be shown on show action
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('name')
            ->add('categories')
            ->add('content')
            ->add('picture')
            ->add('tags')
            ->add('user')
        ;
    }
}