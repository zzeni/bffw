To translate the theme:

- create a po file for your language, for example de_DE.po
. Copy the text from provided POT file into your po file
. Edit the po file with poedit http://www.poedit.net/
 Create the mo file
 and then edit wp-config.php in your installation and set WPLANG so it matches your language like this: define('WPLANG', 'de_DE');
 Theme should now display all messages in your language. BACKUP YOUR PO/MO FILES  becuase when the theme is updated the language files are NOT preserved. 
You will need to manually restore your po/mo files right after the update.

