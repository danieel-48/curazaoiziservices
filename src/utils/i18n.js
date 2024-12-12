import i18next from 'i18next';
import LanguageDetector from 'i18next-browser-languagedetector';

// Configuración de i18next
i18next
  .use(LanguageDetector) // Usar el detector de idioma
  .init({
    resources: {
      en: {
        translation: {
          welcome: 'Welcome to my website',
          about: 'About us',
          contact: 'Contact'
        }
      },
      nl: {
        translation: {
          welcome: 'Bienvenido a mi sitio web',
          about: 'Sobre nosotros',
          contact: 'Contacto'
        }
      }
    },
    fallbackLng: 'en', // Si no se detecta el idioma, usa inglés como predeterminado
    detection: {
      order: ['querystring', 'cookie', 'localStorage', 'navigator'],
      caches: ['cookie'] // Usar cookies para guardar el idioma preferido
    }
  });

export default i18next;
