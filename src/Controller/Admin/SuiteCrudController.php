<?php

namespace App\Controller\Admin;

use App\Entity\Suite;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;

class SuiteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Suite::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre'),
            ImageField::new('image')
            ->setUploadDir('/public/uploads/images/')
            ->setBasePath('uploads/images'),
            TextField::new('description'),
            ImageField::new('galery_image')
            ->setFormTypeOptions([
                "multiple" => true,
            ])
            ->setUploadDir('/public/uploads/images/')
            ->setBasePath('uploads/images'),
            MoneyField::new('prix')
            ->setCurrency('EUR'),
            AssociationField::new('etablissementId')
        ];
    }
    
}
