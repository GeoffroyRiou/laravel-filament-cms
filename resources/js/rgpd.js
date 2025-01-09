import * as CookieConsent from "vanilla-cookieconsent";

const initRGPD = () => {

    CookieConsent.run({

        categories: {
            necessary: {
                enabled: true,  // this category is enabled by default
                readOnly: true  // this category cannot be disabled
            },
            analytics: {}
        },

        language: {
            default: 'fr',
            translations: {
                fr: {
                    consentModal: {
                        title: 'Nous utilisons des cookies',
                        description: '',
                        acceptAllBtn: 'Tout accepter',
                        acceptNecessaryBtn: 'Tout rejeter',
                        showPreferencesBtn: 'Gérer les préférences individuelles'
                    },
                    preferencesModal: {
                        title: 'Gérer les préférences en matière de cookies',
                        acceptAllBtn: 'Tout accepter',
                        acceptNecessaryBtn: 'Tout rejeter',
                        savePreferencesBtn: 'Accepter la sélection actuelle',
                        closeIconLabel: 'Fermer la modale',
                        sections: [
                            {
                                title: 'Quelqu\'un a dit... des cookies ?',
                                description: 'J\'en veux un !'
                            },
                            {
                                title: 'Cookies strictement nécessaires',
                                description: 'Ces cookies sont indispensables au bon fonctionnement du site Internet et ne peuvent être désactivés.',

                                //this field will generate a toggle linked to the 'necessary' category
                                linkedCategory: 'necessary'
                            },
                            {
                                title: 'Performances et analyses',
                                description: 'Ces cookies collectent des informations sur la façon dont vous utilisez notre site Web. Toutes les données sont anonymisées et ne peuvent pas être utilisées pour vous identifier.',
                                linkedCategory: 'analytics'
                            },
                            {
                                title: 'Plus d\'informations',
                                description: 'Pour toute question relative à la politique en matière de cookies et à vos choix, veuillez <a href="#contact-page">nous contacter</a>'
                            }
                        ]
                    }
                }
            }
        }
    });
}

export default initRGPD;