<?php

namespace App\Controller\Admin;

use App\Entity\Plant;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PlantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Plant::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Plante')
            ->setEntityLabelInPlural('Plantes')
            ->setDefaultSort(['commonName' => 'ASC'])
            ->setSearchFields(['commonName', 'scientificName', 'shortDescription']);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            
            TextField::new('commonName', 'Nom commun'),
            TextField::new('scientificName', 'Nom scientifique'),
            
            TextField::new('shortDescription', 'Description courte'),
            TextEditorField::new('longDescription', 'Description longue')->hideOnIndex(),
            
            MoneyField::new('price', 'Prix')
                ->setCurrency('EUR')
                ->setStoredAsCents(false)
                ->setNumDecimals(2)
                ->setRequired(true),
            
            BooleanField::new('isAvailable', 'Disponible'),
            IntegerField::new('availableQuantity', 'Quantité en stock')->hideOnIndex(),
            
            SlugField::new('slug')
                ->setTargetFieldName('commonName')
                ->hideOnIndex(),
            
            ImageField::new('mainImage', 'Photo principale')
                ->setBasePath('uploads/plants/')
                ->setUploadDir('public/uploads/plants/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->onlyOnForms(),
        ];
    }
}