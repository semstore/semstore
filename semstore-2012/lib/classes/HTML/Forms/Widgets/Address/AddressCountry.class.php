<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.0
 *  @date 2005-06-27
 */

require_once('HTML/Forms/Widgets/Basic/ComboBox.class.php');

class AddressCountry extends ComboBox
{
        /*
	 * Class Constants
	 */
	
        
        var $INVALID_OPTION = 1;
        var $Option_Invalid = '-- Select Country --';
        
	/*
	 * Class Variables
	 */
        
        
	/*
	 * Instance Variables
	 */
        
        
        /*
	 * Class Methods
	 */
        
        
        /*
	 * Constructors
	 */
        
        
        function AddressCountry ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, '_AddressCountry'.$numArgs),  $args);
        }
        
        
        function _AddressCountry0 ()
        {
                $this->setId('country');
                $this->_initialise();
        }
        
        
        function _AddressCountry1 ( $id )
        {
                $this->setId($id);
                $this->_initialise();
        }
        
        
        function _initialise ()
        {
                $this->createOption('select_country', '-- Select Country --');
                $this->createOption('af', 'Afghanistan');
                $this->createOption('ax', '&Aring;land Islands');
                $this->createOption('al', 'Albania');
                $this->createOption('dz', 'Algeria');
                $this->createOption('as', 'American Samoa');
                $this->createOption('ad', 'Andorra');
                $this->createOption('ao', 'Angola');
                $this->createOption('ai', 'Anguilla');
                $this->createOption('aq', 'Antarctica');
                $this->createOption('ag', 'Antigua and Barbuda');
                $this->createOption('ar', 'Argentina');
                $this->createOption('am', 'Armenia');
                $this->createOption('aw', 'Aruba');
                $this->createOption('au', 'Australia');
                $this->createOption('at', 'Austria');
                $this->createOption('az', 'Azerbaijan');
                $this->createOption('bs', 'Bahamas');
                $this->createOption('bh', 'Bahrain');
                $this->createOption('bd', 'Bangladesh');
                $this->createOption('bb', 'Barbados');
                $this->createOption('by', 'Belarus');
                $this->createOption('be', 'Belgium');
                $this->createOption('bz', 'Belize');
                $this->createOption('bj', 'Benin');
                $this->createOption('bm', 'Bermuda');
                $this->createOption('bt', 'Bhutan');
                $this->createOption('bo', 'Bolivia');
                $this->createOption('ba', 'Bosnia and Herzegovina');
                $this->createOption('bw', 'Botswana');
                $this->createOption('bv', 'Bouvet Island');
                $this->createOption('br', 'Brazil');
                $this->createOption('io', 'British Indian Ocean territory');
                $this->createOption('bn', 'Brunei Darussalam');
                $this->createOption('bg', 'Bulgaria');
                $this->createOption('bf', 'Burkina Faso');
                $this->createOption('bi', 'Burundi');
                $this->createOption('kh', 'Cambodia');
                $this->createOption('cm', 'Cameroon');
                $this->createOption('ca', 'Canada');
                $this->createOption('cv', 'Cape Verde');
                $this->createOption('ky', 'Cayman Islands');
                $this->createOption('cf', 'Central African Republic');
                $this->createOption('td', 'Chad');
                $this->createOption('cl', 'Chile');
                $this->createOption('cn', 'China');
                $this->createOption('cx', 'Christmas Island');
                $this->createOption('cc', 'Cocos (Keeling) Islands');
                $this->createOption('co', 'Colombia');
                $this->createOption('km', 'Comoros');
                $this->createOption('cg', 'Congo');
                $this->createOption('cd', 'Congo, Democratic Republic');
                $this->createOption('ck', 'Cook Islands');
                $this->createOption('cr', 'Costa Rica');
                $this->createOption('ci', 'C&ocirc;te d\'Ivoire (Ivory Coast)');
                $this->createOption('hr', 'Croatia (Hrvatska)');
                $this->createOption('cu', 'Cuba');
                $this->createOption('cy', 'Cyprus');
                $this->createOption('cz', 'Czech Republic');
                $this->createOption('dk', 'Denmark');
                $this->createOption('dj', 'Djibouti');
                $this->createOption('dm', 'Dominica');
                $this->createOption('do', 'Dominican Republic');
                $this->createOption('ec', 'Ecuador');
                $this->createOption('eg', 'Egypt');
                $this->createOption('sv', 'El Salvador');
                $this->createOption('gq', 'Equatorial Guinea');
                $this->createOption('er', 'Eritrea');
                $this->createOption('ee', 'Estonia');
                $this->createOption('et', 'Ethiopia');
                $this->createOption('fk', 'Falkland Islands');
                $this->createOption('fo', 'Faroe Islands');
                $this->createOption('fj', 'Fiji');
                $this->createOption('fi', 'Finland');
                $this->createOption('fr', 'France');
                $this->createOption('gf', 'French Guiana');
                $this->createOption('pf', 'French Polynesia');
                $this->createOption('tf', 'French Southern Territories');
                $this->createOption('ga', 'Gabon');
                $this->createOption('gm', 'Gambia');
                $this->createOption('ge', 'Georgia');
                $this->createOption('gh', 'Ghana');
                $this->createOption('gi', 'Gibraltar');
                $this->createOption('gr', 'Greece');
                $this->createOption('gl', 'Greenland');
                $this->createOption('gd', 'Grenada');
                $this->createOption('gp', 'Guadeloupe');
                $this->createOption('gu', 'Guam');
                $this->createOption('gt', 'Guatemala');
                $this->createOption('gn', 'Guinea');
                $this->createOption('gw', 'Guinea-Bissau');
                $this->createOption('gy', 'Guyana');
                $this->createOption('ht', 'Haiti');
                $this->createOption('hm', 'Heard and McDonald Islands');
                $this->createOption('hn', 'Honduras');
                $this->createOption('hk', 'Hong Kong');
                $this->createOption('hu', 'Hungary');
                $this->createOption('is', 'Iceland');
                $this->createOption('in', 'India');
                $this->createOption('id', 'Indonesia');
                $this->createOption('ir', 'Iran');
                $this->createOption('iq', 'Iraq');
                $this->createOption('ie', 'Ireland');
                $this->createOption('il', 'Israel');
                $this->createOption('it', 'Italy');
                $this->createOption('jm', 'Jamaica');
                $this->createOption('jp', 'Japan');
                $this->createOption('jo', 'Jordan');
                $this->createOption('kz', 'Kazakhstan');
                $this->createOption('ke', 'Kenya');
                $this->createOption('ki', 'Kiribati');
                $this->createOption('kp', 'Korea (north)');
                $this->createOption('kr', 'Korea (south)');
                $this->createOption('kw', 'Kuwait');
                $this->createOption('kg', 'Kyrgyzstan');
                $this->createOption('la', 'Lao People\'s Democratic Republic');
                $this->createOption('lv', 'Latvia');
                $this->createOption('lb', 'Lebanon');
                $this->createOption('ls', 'Lesotho');
                $this->createOption('lr', 'Liberia');
                $this->createOption('ly', 'Libyan Arab Jamahiriya');
                $this->createOption('li', 'Liechtenstein');
                $this->createOption('lt', 'Lithuania');
                $this->createOption('lu', 'Luxembourg');
                $this->createOption('mo', 'Macao');
                $this->createOption('mk', 'Macedonia');
                $this->createOption('mg', 'Madagascar');
                $this->createOption('mw', 'Malawi');
                $this->createOption('my', 'Malaysia');
                $this->createOption('mv', 'Maldives');
                $this->createOption('ml', 'Mali');
                $this->createOption('mt', 'Malta');
                $this->createOption('mh', 'Marshall Islands');
                $this->createOption('mq', 'Martinique');
                $this->createOption('mr', 'Mauritania');
                $this->createOption('mu', 'Mauritius');
                $this->createOption('yt', 'Mayotte');
                $this->createOption('mx', 'Mexico');
                $this->createOption('mf', 'Micronesia');
                $this->createOption('md', 'Moldova');
                $this->createOption('mc', 'Monaco');
                $this->createOption('mn', 'Mongolia');
                $this->createOption('ms', 'Montserrat');
                $this->createOption('ma', 'Morocco');
                $this->createOption('mz', 'Mozambique');
                $this->createOption('mm', 'Myanmar');
                $this->createOption('na', 'Namibia');
                $this->createOption('nr', 'Nauru');
                $this->createOption('np', 'Nepal');
                $this->createOption('nl', 'Netherlands');
                $this->createOption('an', 'Netherlands Antilles');
                $this->createOption('nc', 'New Caledonia');
                $this->createOption('nz', 'New Zealand');
                $this->createOption('ni', 'Nicaragua');
                $this->createOption('ne', 'Niger');
                $this->createOption('ng', 'Nigeria');
                $this->createOption('nu', 'Niue');
                $this->createOption('nf', 'Norfolk Island');
                $this->createOption('mp', 'Northern Mariana Islands');
                $this->createOption('no', 'Norway');
                $this->createOption('om', 'Oman');
                $this->createOption('pk', 'Pakistan');
                $this->createOption('pw', 'Palau');
                $this->createOption('ps', 'Palestinian Territories');
                $this->createOption('pa', 'Panama');
                $this->createOption('pg', 'Papua New Guinea');
                $this->createOption('py', 'Paraguay');
                $this->createOption('pe', 'Peru');
                $this->createOption('ph', 'Philippines');
                $this->createOption('pn', 'Pitcairn');
                $this->createOption('pl', 'Poland');
                $this->createOption('pt', 'Portugal');
                $this->createOption('pr', 'Puerto Rico');
                $this->createOption('qa', 'Qatar');
                $this->createOption('re', 'R&eacute;union');
                $this->createOption('ro', 'Romania');
                $this->createOption('ru', 'Russian Federation');
                $this->createOption('rw', 'Rwanda');
                $this->createOption('sh', 'Saint Helena');
                $this->createOption('kn', 'Saint Kitts and Nevis');
                $this->createOption('lc', 'Saint Lucia');
                $this->createOption('pm', 'Saint Pierre and Miquelon');
                $this->createOption('vc', 'Saint Vincent and the Grenadines');
                $this->createOption('ws', 'Samoa');
                $this->createOption('sm', 'San Marino');
                $this->createOption('st', 'Sao Tome and Principe');
                $this->createOption('sa', 'Saudi Arabia');
                $this->createOption('sn', 'Senegal');
                $this->createOption('cs', 'Serbia and Montenegro');
                $this->createOption('sc', 'Seychelles');
                $this->createOption('sl', 'Sierra Leone');
                $this->createOption('sg', 'Singapore');
                $this->createOption('sk', 'Slovakia');
                $this->createOption('si', 'Slovenia');
                $this->createOption('sb', 'Solomon Islands');
                $this->createOption('so', 'Somalia');
                $this->createOption('za', 'South Africa');
                $this->createOption('gs', 'South Georgia and the South Sandwich Islands');
                $this->createOption('es', 'Spain');
                $this->createOption('lk', 'Sri Lanka');
                $this->createOption('sd', 'Sudan');
                $this->createOption('sr', 'Suriname');
                $this->createOption('sj', 'Svalbard and Jan Mayen Islands');
                $this->createOption('sz', 'Swaziland');
                $this->createOption('se', 'Sweden');
                $this->createOption('ch', 'Switzerland');
                $this->createOption('sy', 'Syria');
                $this->createOption('tw', 'Taiwan');
                $this->createOption('tj', 'Tajikistan');
                $this->createOption('tz', 'Tanzania');
                $this->createOption('th', 'Thailand');
                $this->createOption('tl', 'Timor-leste');
                $this->createOption('tg', 'Togo');
                $this->createOption('tk', 'Tokelau');
                $this->createOption('to', 'Tonga');
                $this->createOption('tt', 'Trinidad and Tobago');
                $this->createOption('tn', 'Tunisia');
                $this->createOption('tr', 'Turkey');
                $this->createOption('tm', 'Turkmenistan');
                $this->createOption('tc', 'Turks and Caicos Islands');
                $this->createOption('tv', 'Tuvalu');
                $this->createOption('ug', 'Uganda');
                $this->createOption('ua', 'Ukraine');
                $this->createOption('ae', 'United Arab Emirates');
                $this->createOption('gb', 'United Kingdom');
                $this->createOption('us', 'United States');
                $this->createOption('um', 'United States Minor Outlying Islands');
                $this->createOption('uy', 'Uruguay');
                $this->createOption('uz', 'Uzbekistan');
                $this->createOption('vu', 'Vanuatu');
                $this->createOption('va', 'Vatican City State');
                $this->createOption('ve', 'Venezuela');
                $this->createOption('vi', 'Vietnam');
                $this->createOption('vg', 'Virgin Islands (British)');
                $this->createOption('vi', 'Virgin Islands (US)');
                $this->createOption('wf', 'Wallis and Futuna Islands');
                $this->createOption('eh', 'Western Sahara');
                $this->createOption('ye', 'Yemen');
                $this->createOption('zm', 'Zambia');
                $this->createOption('zw', 'Zimbabwe');
        }
        
        
        /*
	 * Accessor & Mutator Methods
	 */
        
        
        /*
	 * Command Methods
	 */
        
        
        function &validate ()
        {
                $errors = array();
                
                if ( !$this->isValidOption($this->getSelected()) )
                {
                        $errors[$this->INVALID_OPTION] =
                                'Please select a valid Country';
                }
                elseif ( $this->getSelected() == 'select_country' )
                {
                        $errors[$this->INVALID_OPTION] =
                                'Please select a valid County';
                }
                
                return $errors;
        }
        
        
}

?>
