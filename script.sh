#!/bin/bash

# Supprimer les fichiers créés par make:auth
rm -rf src/Security/
rm -f config/packages/security.yaml
rm -f config/routes/security.yaml
rm -f config/routes/reset_password.yaml
rm -f templates/security/*

# Supprimer les fichiers créés par make:email_verifier
rm -rf src/Mailer/
rm -f config/packages/mailer.yaml
rm -f config/packages/reset_password.yaml
rm -f config/routes/verify_email.yaml
rm -f templates/registration/*
rm -f templates/reset_password/*
rm -f templates/registration.txt.twig
rm -f templates/reset_password.txt.twig

# Supprimer les fichiers créés par make:registration-form
rm -rf src/Form/UserRegistrationFormType.php
rm -rf src/Controller/RegistrationController.php
rm -f config/packages/twig.yaml
rm -f templates/registration/register.html.twig
rm -f templates/registration/register.txt.twig

# Supprimer les entrées de bundles dans config/bundles.php
sed -i '/SymfonyCasts\/Bundle\/ResetPasswordBundle/d' config/bundles.php
sed -i '/SymfonyCasts\\Bundle\\VerifyEmailBundle\\VerifyEmailBundle::class/d' config/bundles.php
sed -i '/SymfonyCasts\\Bundle\\RegistrationFormBundle\\RegistrationFormBundle::class/d' config/bundles.php
