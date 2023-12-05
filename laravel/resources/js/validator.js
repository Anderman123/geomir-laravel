import Validator from 'validatorjs';
import ca from 'validatorjs/src/lang/ca'; // Importa los archivos de idioma
import es from 'validatorjs/src/lang/es';
import en from 'validatorjs/src/lang/en';

Validator.setMessages('ca', ca); // Configura los mensajes de idioma
Validator.setMessages('es', es);
Validator.setMessages('en', en);

const locale = (typeof currentLocale === 'undefined') ? 'ca' : currentLocale; // Determina el idioma actual o predeterminado
Validator.useLang(locale);

export default Validator;
