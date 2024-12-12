import english from '@/i18n/languages/en.json';
import nearlandes from '@/i18n/languages/nl.json';

const LANG = {
    NEARLANDES: 'nl' ,
    ENGLSIH: 'en',
};

export const getI18N = ({
    currentLocale = 'en',
   
}: {
    currentLocale: string | undefined;
    
})=> {
    if(currentLocale === LANG.NEARLANDES) return {...english, ...nearlandes};
    return english;
};



