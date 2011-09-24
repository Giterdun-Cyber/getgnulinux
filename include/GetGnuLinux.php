<?php

class GetGnuLinux {
    // define properties
    var $config = array(
        'locale' => "en_GB",
        'gettext_domain' => "getgnulinux",
        'dir' => "ltr",
        'locales' => array(
            'ar' => array('ar_SA.UTF-8',"الرئيسية",'rtl',"العربية", "احصل على هذه الصفحة باللغة العربية !"),
            'ca' => array('ca_AD.UTF-8',"Inici",'ltr',"català", "Traduïu aquesta pàgina a la llengua català!"),
            'da' => array('da_DK.UTF-8',"Home",'ltr',"dansk sprog", "Watch this page in Danish"),
            'en' => array('en_GB.UTF-8',"Home",'ltr',"English", "Watch this page in English"),
            'de' => array('de_DE.UTF-8',"Home",'ltr',"Deutsch", "Watch this page in German"),
            'es' => array('es_ES.UTF-8',"Inicio",'ltr',"castellano", "¡Lee esta página en castellano!"),
            'fr' => array('fr_FR.UTF-8',"Accueil",'ltr',"français", "Cette page en français"),
            'hr' => array('hr_HR.UTF-8',"Home",'ltr',"hrvatski jezik", "Watch this page in Croatian"),
            #'id' => array('id_ID.UTF-8',"Home",'ltr',"Bahasa Indonesia", "Watch this page in Indonesian"),
            'it' => array('it_IT.UTF-8',"Home",'ltr',"italiano", "Watch this page in Italian"),
            'ja' => array('ja_JP.UTF-8',"Home",'ltr',"日本語", "Watch this page in Japanese"),
            'ml' => array('ml_IN',"Home",'ltr',"മലയാളം", "Watch this page in Malayalam"),
            'nl' => array('nl_NL.UTF-8',"Hoofdpagina",'ltr',"Nederlands", "Bekijk deze pagina in het Nederlands"),
            'pt' => array('pt_PT.UTF-8',"Home",'ltr',"português", "Watch this page in Portuguese"),
            'ru' => array('ru_RU.UTF-8',"Домой",'ltr',"русский", "Просмотреть эту страницу на русский языке!"),
            'sr' => array('sr_RS',"Home",'ltr',"српски", "Watch this page in Serbian"),
            'uk' => array('uk_UA.UTF-8',"Додому",'ltr',"українська", "Переглянути цю сторінку на українська мові!"),
            'tr' => array('tr_TR.UTF-8',"Home",'ltr',"Türkçe", "Watch this page in Turkish"),
            'vi' => array('vi_VN',"Nhà",'ltr',"Tiếng Việt", "Xem trang này bằng tiếng Tiếng Việt !"),
            'zh' => array('zh_CN.UTF-8',"Home",'ltr',"汉语", "Watch this page in Chinese"),
            )
        );

    // constructor
    function __construct() {
        # Set the locale.
        $locale = isset($_GET['l']) ? $_GET['l'] : "en_GB";
        $this->set('locale', $locale);

        # Set the text direction.
        $dir = $this->config['locales'][$this->get('lang')][2];
        $this->set('dir', $dir);

        # Initialize gettext.
        $this->init_gettext();

        # Set page titles for <title> tags.
        $this->config['page_titles'] = array(
            # i18n: The way you refer to a website's main page in your language.
            'home' => _("Home"),
            # i18n: Try to be as concise and short as possible. This appears in the top header menu and must be easily readable.
            'more' => _("More"),
            # i18n: Try to be as concise and short as possible. This appears in the top header menu and must be easily readable.
            'linux' => _("What is Linux?"),
            # i18n: The term 'FAQ' may not be meaningful, or have an equivalent acronym in your language. If so, just skip the term.
            'linux.linux_faq' => _("Linux FAQ - common questions about GNU/Linux"),
            # i18n: Here the intent is to be a little provocative. Exact translation is not required.
            'linux.misunderstanding_free_software' => _("How to Misunderstand Free Software"),
            # i18n: This is the title of the 'Screenshots' page.
            'linux.screenshots' => _("What GNU/Linux looks like"),
            # i18n: If it makes sense in your language, do not formulate 'why not windows' as a question. This appears in the top header menu and should be as short and concise as possible.
            'windows' => _("Why not Windows"),
            # i18n: This title can be translated loosely
            'windows.restrictions' => _("Restrictions"),
            # i18n: This title can be translated loosely
            'windows.restrictions.further_details' => _("More details on restrictions"),
            # i18n: This title can be translated loosely
            'windows.stand_for_a_free_society' => _("Stand for a free society"),
            # i18n: This title can be translated loosely
            'windows.what_about_choice' => _("What about choice?"),
            # i18n: This title can be translated loosely
            'windows.what_about_source_code' => _("No source code"),
            # i18n: This appears in the top header menu and should be as short and concise as possible.
            'switch_to_linux' => _("Switch to Linux"),
            'switch_to_linux.choose_a_distribution' => _("Choose a distribution"),
            'switch_to_linux.from_windows_to_linux' => _("From Windows to Linux"),
            # i18n: This should be translated as if it was 'Try *and* install'. In English there was possible confusion (with 'try to install') but this was the intended title.
            'switch_to_linux.try_or_install' => _("Try or install"),
        );

        # Set page descriptions.
        $this->config['page_descriptions'] = array(
            # i18n: This is the description of the homepage, and it appears in Google results! Please pay particular attention to this one =)
            'default' => _("Get GNU/Linux! A simple, clear website about Linux. | What is Linux? | Why not Windows? | Tips to make the switch"),
            # i18n: This is the description of the 'More' page
            'more' => _("Read and discover more about Linux."),
            # i18n: This is the description of the 'Linux' page
            'linux' => _("What is Linux? A clear explanation."),
            # i18n: This is the description of the 'Linux FAQ' page
            'linux.linux_faq' => _("Frequently Asked Questions about GNU/Linux."),
            # i18n: This is the description of the 'Misunderstanding Free Software' page
            'linux.misunderstanding_free_software' => _("An unconventional way to (re)discover free software."),
            # i18n: This is the description of the 'Screenshots' page
            'linux.screenshots' => _("A brief look at Linux in everyday use."),
            # i18n: This is the description of the 'Why not Windows' page
            'windows' => _("Four good reasons to avoid proprietary software."),
            # i18n: This is the description of the 'Restrictions' page
            'windows.restrictions' => _("Restrictions in a proprietary software license."),
            # i18n: This is the description of the 'Restrictions further details' page
            'windows.restrictions.further_details' => _("Restrictions in a proprietary software license - more details."),
            # i18n: This is the description of the 'Stand for a free society' page
            'windows.stand_for_a_free_society' => _("How software affects freedom in society."),
            # i18n: This is the description of the 'What about choice' page
            'windows.what_about_choice' => _("How Microsoft lock customers in."),
            # i18n: This is the description of the 'What about source code' page
            'windows.what_about_source_code' => _("No source code means no trust and no security."),
            # i18n: This is the description of the 'Switch to Linux' page
            'switch_to_linux' => _("Switch to Linux: Good tips and advice."),
            # i18n: This is the description of the 'Choose a distribution' page
            'switch_to_linux.choose_a_distribution' => _("Recommended Linux distributions for everyday users."),
            # i18n: This is the description of the 'From Windows to Linux' page
            'switch_to_linux.from_windows_to_linux' => _("The advantages and disadvantages of Linux over Windows."),
            # i18n: This is the description of the 'Try or Install' page. i18n note: this should be translated as if it was 'Try *and* install'. In English there was possible confusion (with 'try to install') but this was the intended title.
            'switch_to_linux.try_or_install' => _("Try or install Linux on your computer, very easily."),
        );
    }

    // define methods
    function init_gettext() {
        # Initialize gettext. Configure gettext to look in
        # /locale/xx_YY/LC_MESSAGES/ for gettext_domain.mo.
        $gettext_domain = $this->get('gettext_domain');

        # Set language.
        putenv("LANG=".$this->get('locale'));
        setlocale(LC_ALL, $this->get('locale'));

        # Specify location of translation tables
        bindtextdomain($gettext_domain, "locale/");

        # Choose domain
        textdomain($gettext_domain);
    }

	function set($key, &$value)
    {
        if ($key == 'locale') {
            $this->set_locale($value);
            return;
        }
		$this->config[$key] =& $value;
	}

    function set_locale($locale)
    {
        if ( array_key_exists($locale, $this->config['locales']) ) {
            $this->config['locale'] = $this->config['locales'][$locale][0];
        }
    }

    function get($key, $default='')
    {
        if ($key == 'lang') {
            return substr($this->config['locale'], 0, 2);
        }
        else if ($key == 'country_code') {
            return strtolower(substr($this->config['locale'], 3, 2));
        }

		if ( isset($this->config[$key]) ) {
			return $this->config[$key];
		}
		return $default;
    }
}

?>
