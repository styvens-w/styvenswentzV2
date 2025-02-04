<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    #[Assert\Length(min: 2, max: 50)]
    #[Assert\NotBlank(message: "Le prénom ne peut pas être vide.")]
    public string $firstname;

    #[Assert\Length(min: 2, max: 50)]
    #[Assert\NotBlank(message: "Le nom ne peut pas être vide.")]
    public string $lastname;

    #[Assert\Email]
    #[Assert\NotBlank(message: "Le mail ne peut pas être vide.")]
    public string $email;

    #[Assert\Length(min: 2, max: 255)]
    #[Assert\NotBlank(message: "Le sujet ne peut pas être vide.")]
    public string $subject;

    #[Assert\Length(min: 10, max: 5000)]
    #[Assert\NotBlank(message: "Le message ne peut pas être vide.")]
    public string $message;
}
