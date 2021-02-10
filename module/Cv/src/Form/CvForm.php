<?php

declare(strict_types=1);

namespace Cv\Form;

use Cv\Entity\Cv;
use Laminas\Filter\File\RenameUpload;
use Laminas\Filter\StringTrim;
use Laminas\Filter\StripTags;
use Laminas\Filter\ToInt;
use Laminas\Form\Element\Email;
use Laminas\Form\Element\File;
use Laminas\Form\Element\Hidden;
use Laminas\Form\Element\Select;
use Laminas\Form\Element\Submit;
use Laminas\Form\Element\Tel;
use Laminas\Form\Element\Text;
use Laminas\Form\Element\Textarea;
use Laminas\Form\Form;
use Laminas\InputFilter\InputFilter;
use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\InputFilter\InputFilterInterface;
use Laminas\Validator\EmailAddress;
use Laminas\Validator\File\MimeType;
use Laminas\Validator\File\Size;
use Laminas\Validator\StringLength;

class CvForm extends Form implements InputFilterAwareInterface
{
    protected ?InputFilter $inputFilter = null;


    protected function __construct()
    {
        parent::__construct('cv-form');

        $this->addElements();
        $this->setInputFilter();
    }


    public static function create(): self
    {
        return new self();
    }


    protected function addElements(): self
    {
        $this->add(
            [
                'name' => Cv::ID,
                'type' => Hidden::class,
            ]
        )
             ->add(
                 [
                     'name'    => Cv::NAME,
                     'type'    => Text::class,
                     'options' => [
                         'label' => 'Name',
                     ],
                 ]
             )
             ->add(
                 [
                     'name'    => Cv::EMAIL,
                     'type'    => Email::class,
                     'options' => [
                         'label' => 'Email',
                     ],
                 ]
             )
             ->add(
                 [
                     'name'    => Cv::TELEPHONE,
                     'type'    => Tel::class,
                     'options' => [
                         'label' => 'Phone number',
                     ],
                 ]
             )
             ->add(
                 [
                     'name'    => Cv::POSITION,
                     'type'    => Text::class,
                     'options' => [
                         'label' => 'Position',
                     ],
                 ]
             )
             ->add(
                 [
                     'name'    => Cv::EDUCATION,
                     'type'    => Select::class,
                     'options' => [
                         'label'         => 'Education',
                         'empty_option'  => 'Select an option',
                         'value_options' => Cv::EDUCATION_TO_LABEL
                     ],
                 ]
             )
             ->add(
                 [
                     'name'    => Cv::COMMENTS,
                     'type'    => Textarea::class,
                     'options' => [
                         'label' => 'Comments',
                     ],
                 ]
             )
             ->add(
                 [
                     'name'    => Cv::FILE,
                     'type'    => File::class,
                     'options' => [
                         'label' => 'File',
                     ],
                 ]
             )
             ->add(
                 [
                     'name'       => 'submit',
                     'type'       => Submit::class,
                     'attributes' => [
                         'value' => 'Submit',
                         'id'    => 'submit-button',
                     ],
                 ]
             );

        return $this;
    }


    public function setInputFilter(?InputFilterInterface $inputFilter = null): InputFilterAwareInterface
    {
        parent::setInputFilter($this->getInputFilter());

        return $this;
    }


    public function getInputFilter(): InputFilterInterface
    {
        if ($this->inputFilter) {
            return $this->inputFilter;
        }

        $inputFilter = new InputFilter();

        $inputFilter->add(
            [
                'name'     => Cv::ID,
                'required' => true,
                'filters'  => [
                    ['name' => ToInt::class],
                ],
            ]
        );

        $inputFilter->add(
            [
                'name'       => Cv::NAME,
                'required'   => true,
                'filters'    => [
                    ['name' => StripTags::class],
                    ['name' => StringTrim::class],
                ],
                'validators' => [
                    [
                        'name'    => StringLength::class,
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ],
                    ],
                ],
            ]
        );

        $inputFilter->add(
            [
                'name'       => Cv::EMAIL,
                'required'   => true,
                'filters'    => [
                    ['name' => StripTags::class],
                    ['name' => StringTrim::class],
                ],
                'validators' => [
                    [
                        'name' => EmailAddress::class,
                    ],
                ],
            ]
        );

        $inputFilter->add(
            [
                'name'       => Cv::TELEPHONE,
                'required'   => true,
                'filters'    => [
                    ['name' => StripTags::class],
                    ['name' => StringTrim::class],
                ],
                'validators' => [
                    [
                        'name'    => StringLength::class,
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min'      => 5,
                            'max'      => 20,
                        ],
                    ],
                ],
            ]
        );

        $inputFilter->add(
            [
                'name'       => Cv::POSITION,
                'required'   => true,
                'filters'    => [
                    ['name' => StripTags::class],
                    ['name' => StringTrim::class],
                ],
                'validators' => [
                    [
                        'name'    => StringLength::class,
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 20,
                        ],
                    ],
                ],
            ]
        );

        $inputFilter->add(
            [
                'name'     => Cv::EDUCATION,
                'required' => true,
                'filters'  => [
                    ['name' => StripTags::class],
                    ['name' => StringTrim::class],
                ],
            ]
        );

        $inputFilter->add(
            [
                'name'     => Cv::COMMENTS,
                'required' => false,
                'filters'  => [
                    ['name' => StripTags::class],
                    ['name' => StringTrim::class],
                ],
            ]
        );

        $inputFilter->add(
            [
                'name'       => Cv::FILE,
                'required'   => true,
                'filters'    => [
                    ['name' => StripTags::class],
                    ['name' => StringTrim::class],
                ],
                'validators' => [
                    [
                        'name'    => Size::class,
                        'options' => [
                            'max' => 1048576, // 1 MB
                        ],
                    ],
                    [
                        'name'    => MimeType::class,
                        'options' => [
                            // accepts .pdf, .doc, .docx
                            'mimeType' => 'application/pdf,application/msword,application/octet-stream',
                        ],
                    ],
                ],
            ]
        );

        $this->inputFilter = $inputFilter;

        return $this->inputFilter;
    }
}
