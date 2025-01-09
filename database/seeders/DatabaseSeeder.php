<?php

namespace Database\Seeders;

use App\Enums\UserRoles;
use App\Models\ContactForm;
use App\Models\Settings;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'geoffroy.riou.pro@gmail.com',
            'password' => bcrypt('3DHjV9DteUVVvt47urQ5'),
            'role' => UserRoles::Admin->value,
        ]);

        Settings::create([
            'facebook' => '',
            'linkedin' => '',
            'x' => '',
            'instagram' => '',
            'telephone' => '',
            'adresse' => '',
            'email' => '',
        ]);

        $form = ContactForm::make([
            'nom' => 'Formulaire de contact',
            'champs' => null,
            'sujet' => 'Demande de contact',
            'destinataires' => 'geoffroy.riou.pro@gmail.com',
        ]);
        $form->setTranslations('champs', ['fr' => json_decode('[{"type":"texte","data":{"label":"Input texte","slug":"texte","type":"ligne","requis":true}},{"type":"bloc_texte","data":{"label":"Text area","slug":"textarea","requis":true}},{"type":"choix","data":{"label":"Fruits","slug":"Fruits","valeurs":{"pomme":"Pomme","poire":"Poire","ananas":"Ananas"},"type":"checkbox","requis":true}},{"type":"choix","data":{"label":"Légumes","slug":"legume","valeurs":{"carotte":"Carotte","poireau":"Poireau"},"type":"radio","requis":true}},{"type":"choix","data":{"label":"Animaux","slug":"animaux","valeurs":{"chien":"Chien","chat":"Chat"},"type":"select","requis":true}},{"type":"fichier","data":{"label":"Fichier","slug":"fichier","format":"png,jpg","requis":true}},{"type":"optin","data":{"slug":"mentions","texte":"<p>J\'accepte blablabla. Voir la <a href=\"http://dddd.fr\">politique de confidentialité</a>.</p>","requis":true}}]')]);

        $form->save();
    }
}
