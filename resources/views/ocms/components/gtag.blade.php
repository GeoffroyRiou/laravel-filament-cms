@php($gtag = $settings->gtag ?? null)
@if (!empty($gtag))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $gtag }}"></script>
    <script>
        // Define dataLayer and the gtag function.
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        // Paramètres par défaut, aucun consentement
        gtag('consent', 'default', {
            'ad_storage': 'denied',
            'ad_user_data': 'denied',
            'ad_personalization': 'denied',
            'analytics_storage': 'denied'
        });

        gtag('js', new Date());
        gtag('config', '{{ $gtag }}');
    </script>
    <script data-category="analytics" type="text/plain" data-service="Google Analytics - Stockage lié à l'analyse (visites, durée...)">
        gtag('consent', 'update', {
            'analytics_storage': 'granted'
        });
    </script>
    <script data-category="analytics" type="text/plain" data-service="Google Analytics - Stockage lié à la publicité">
        gtag('consent', 'update', {
            'ad_storage': 'granted',
        });
    </script>
    <script data-category="analytics" type="text/plain" data-service="Google Analytics - Envoi des données utilisateur">
        gtag('consent', 'update', {
            'ad_user_data': 'granted',
        });
    </script>
    <script data-category="analytics" type="text/plain" data-service="Google Analytics - Publicité personnalisée">
        gtag('consent', 'update', {
            'ad_personalization': 'granted',
        });
    </script>
@endif
