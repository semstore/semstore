<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-06-27
 * @package HTML.Forms.Widgets.Address
 */

require_once('HTML/Forms/Widgets/Basic/ComboBox.class.php');

class AddressCounty extends ComboBox
{
        /*
	 * Class Constants
	 */
	
        
        var $INVALID_OPTION = 1;
        
        
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
        
        
        function AddressCounty ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, '_AddressCounty'.$numArgs),  $args);
        }
        
        
        function _AddressCounty0 ()
        {
                $this->setName('county');
                $this->_initialise();
        }
        
        
        function _AddressCounty1 ( $name )
        {
                $this->setName($name);
                $this->_initialise();
        }
        
        
        function _initialise ()
        {
                $this->createOption('select_county', '-- Select County --');
                $this->createOption('avon', 'Avon');
                $this->createOption('bedfordshire', 'Bedfordshire');
                $this->createOption('berkshire', 'Berkshire');
                $this->createOption('bristol', 'Bristol');
                $this->createOption('buckinghamshire', 'Buckinghamshire');
                $this->createOption('cambridgeshire', 'Cambridgeshire');
                $this->createOption('cheshire', 'Cheshire');
                $this->createOption('cleveland', 'Cleveland');
                $this->createOption('cornwall', 'Cornwall');
                $this->createOption('cumbria', 'Cumbria');
                $this->createOption('derbyshire', 'Derbyshire');
                $this->createOption('devon', 'Devon');
                $this->createOption('dorset', 'Dorset');
                $this->createOption('durham', 'Durham');
                $this->createOption('east riding of yorkshire', 'East riding of yorkshire');
                $this->createOption('east sussex', 'East sussex');
                $this->createOption('essex', 'Essex');
                $this->createOption('gloucestershire', 'Gloucestershire');
                $this->createOption('greater manchester', 'Greater manchester');
                $this->createOption('hampshire', 'Hampshire');
                $this->createOption('herefordshire', 'Herefordshire');
                $this->createOption('hertfordshire', 'Hertfordshire');
                $this->createOption('humberside', 'Humberside');
                $this->createOption('isle of wight', 'Isle of wight');
                $this->createOption('isles of scilly', 'Isles of scilly');
                $this->createOption('kent', 'Kent');
                $this->createOption('lancashire', 'Lancashire');
                $this->createOption('leicestershire', 'Leicestershire');
                $this->createOption('lincolnshire', 'Lincolnshire');
                $this->createOption('london', 'London');
                $this->createOption('merseyside', 'Merseyside');
                $this->createOption('middlesex', 'Middlesex');
                $this->createOption('norfolk', 'Norfolk');
                $this->createOption('north yorkshire', 'North yorkshire');
                $this->createOption('northamptonshire', 'Northamptonshire');
                $this->createOption('northumberland', 'Northumberland');
                $this->createOption('nottinghamshire', 'Nottinghamshire');
                $this->createOption('oxfordshire', 'Oxfordshire');
                $this->createOption('rutland', 'Rutland');
                $this->createOption('shropshire', 'Shropshire');
                $this->createOption('somerset', 'Somerset');
                $this->createOption('south yorkshire', 'South yorkshire');
                $this->createOption('staffordshire', 'Staffordshire');
                $this->createOption('suffolk', 'Suffolk');
                $this->createOption('surrey', 'Surrey');
                $this->createOption('tyne and wear', 'Tyne and wear');
                $this->createOption('warwickshire', 'Warwickshire');
                $this->createOption('west midlands', 'West midlands');
                $this->createOption('west sussex', 'West sussex');
                $this->createOption('west yorkshire', 'West yorkshire');
                $this->createOption('wiltshire', 'Wiltshire');
                $this->createOption('worcestershire', 'Worcestershire');
                $this->createOption('spacer1', '');
                $this->createOption('northern_ireland', '-- Northern Ireland --');
                $this->createOption('antrim', 'Antrim');
                $this->createOption('armagh', 'Armagh');
                $this->createOption('down', 'Down');
                $this->createOption('fermanagh', 'Fermanagh');
                $this->createOption('londonderry', 'Londonderry');
                $this->createOption('tyrone', 'Tyrone');
                $this->createOption('spacer2', '');
                $this->createOption('scotland', '-- Scotland --');
                $this->createOption('aberdeen city', 'Aberdeen city');
                $this->createOption('aberdeenshire', 'Aberdeenshire');
                $this->createOption('angus', 'Angus');
                $this->createOption('argyll and bute', 'Argyll and bute');
                $this->createOption('borders', 'Borders');
                $this->createOption('clackmannan', 'Clackmannan');
                $this->createOption('dumfries and galloway', 'Dumfries and galloway');
                $this->createOption('dundee (city of)', 'Dundee (city of)');
                $this->createOption('east ayrshire', 'East ayrshire');
                $this->createOption('east dunbartonshire', 'East dunbartonshire');
                $this->createOption('east lothian ', 'East lothian ');
                $this->createOption('east renfrewshire', 'East renfrewshire');
                $this->createOption('edinburgh (city of)', 'Edinburgh (city of)');
                $this->createOption('falkirk', 'Falkirk');
                $this->createOption('fife', 'Fife');
                $this->createOption('glasgow (city of)', 'Glasgow (city of)');
                $this->createOption('highland', 'Highland');
                $this->createOption('inverclyde', 'Inverclyde');
                $this->createOption('midlothian', 'Midlothian');
                $this->createOption('moray', 'Moray');
                $this->createOption('north ayrshire', 'North ayrshire');
                $this->createOption('north lanarkshire', 'North lanarkshire');
                $this->createOption('orkney', 'Orkney');
                $this->createOption('perthshire and kinross', 'Perthshire and kinross');
                $this->createOption('renfrewshire', 'Renfrewshire');
                $this->createOption('shetland', 'Shetland');
                $this->createOption('south ayrshire', 'South ayrshire');
                $this->createOption('south lanarkshire', 'South lanarkshire');
                $this->createOption('stirling ', 'Stirling ');
                $this->createOption('west dunbartonshire', 'West dunbartonshire');
                $this->createOption('west lothian', 'West lothian');
                $this->createOption('western isles', 'Western isles');
                $this->createOption('spacer3', '');
                $this->createOption('unitary_authorities_of_wales', '-- Unitary Authorities of Wales --');
                $this->createOption('blaenau gwent', 'Blaenau gwent');
                $this->createOption('bridgend', 'Bridgend');
                $this->createOption('caerphilly', 'Caerphilly');
                $this->createOption('cardiff', 'Cardiff');
                $this->createOption('carmarthenshire', 'Carmarthenshire');
                $this->createOption('ceredigion', 'Ceredigion');
                $this->createOption('conwy', 'Conwy');
                $this->createOption('denbighshire', 'Denbighshire');
                $this->createOption('flintshire', 'Flintshire');
                $this->createOption('gwynedd', 'Gwynedd');
                $this->createOption('isle of anglesey', 'Isle of anglesey');
                $this->createOption('merthyr tydfil', 'Merthyr tydfil');
                $this->createOption('monmouthshire', 'Monmouthshire');
                $this->createOption('neath port talbot', 'Neath port talbot');
                $this->createOption('newport', 'Newport');
                $this->createOption('pembrokeshire', 'Pembrokeshire');
                $this->createOption('powys', 'Powys');
                $this->createOption('rhondda cynon taff', 'Rhondda cynon taff');
                $this->createOption('swansea', 'Swansea');
                $this->createOption('tofaen', 'Tofaen');
                $this->createOption('the vale of glamorgan', 'The vale of glamorgan');
                $this->createOption('wrexham', 'Wrexham');
                $this->createOption('spacer4', '');
                $this->createOption('uk_offshore_dependencies', '-- UK Offshore Dependencies --');
                $this->createOption('channel islands', 'Channel islands');
                $this->createOption('isle of man', 'Isle of man');
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
                        //array_push($errors, 'Please select a valid option for the County field.');
                        $errors[$this->INVALID_OPTION] =
                                'Please select a valid County';
                }
                elseif ( $this->getSelected() == 'select_county' )
                {
                        //array_push($errors, 'Please select a valid option for the County field.');
                        $errors[$this->INVALID_OPTION] =
                                'Please select a valid County';
                }
                elseif ( $this->getSelected() == 'northern_ireland' )
                {
                        //array_push($errors, 'Please select a valid option for the County field.');
                        $errors[$this->INVALID_OPTION] =
                                'Please select a valid County';
                }
                elseif ( $this->getSelected() == 'scotland' )
                {
                        //array_push($errors, 'Please select a valid option for the County field.');
                        $errors[$this->INVALID_OPTION] =
                                'Please select a valid County';
                }
                elseif ( $this->getSelected() == 'unitary_authorities_of_wales' )
                {
                        //array_push($errors, 'Please select a valid option for the County field.');
                        $errors[$this->INVALID_OPTION] =
                                'Please select a valid County';
                }
                elseif ( $this->getSelected() == 'uk_offshore_dependencies' )
                {
                        //array_push($errors, 'Please select a valid option for the County field.');
                        $errors[$this->INVALID_OPTION] =
                                'Please select a valid County';
                }
                elseif ( preg_match('{spacer(1|2|3|4)}', $this->getSelected()) )
                {
                        //array_push($errors, 'Please select a valid option for the County field.');
                        $errors[$this->INVALID_OPTION] =
                                'Please select a valid County';
                }
                
                
                return $errors;
        }
        
        
}

?>
