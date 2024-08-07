<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Admin Class
 *
 * Manage Admin Panel Class
 *
 * @package Kafco
 * @since 1.0.0
 */

class Kafco_Admin {

	public $scripts;

	//class constructor
	function __construct() {

		global $arab_funds_scripts;

		$this->scripts = $arab_funds_scripts;
	}

	/**
	 * Admin Class
	 *
	 * Custom method to handle all translations strings in Kafco
	 *
	 * @package Kafco
	 * @since 1.0.0
	*/

	function kafco_load_all_translation_strings() {
		pll_register_string( 'username', 'Username', 'kafco', false );
        pll_register_string( 'password', 'Password', 'kafco', false );
		pll_register_string( 'customerlogin', 'Customer Login', 'kafco', false );
		pll_register_string( 'password', 'Customer Login', 'kafco', false );
		pll_register_string( 'termsconditions', 'Terms of Use and Conditions', 'kafco', false );
		pll_register_string( 'login', 'Login', 'kafco', false );
		pll_register_string( 'iaccept', 'I Accept the', 'kafco', false );
		pll_register_string( 'contractsummary', 'Contract Summary', 'kafco', false );
		pll_register_string( 'agreementdate', 'Agreement Date', 'kafco', false );
		pll_register_string( 'paymentcurrency', 'Invoice/ Payment Currency', 'kafco', false );
		pll_register_string( 'creditdays', 'Credit Days', 'kafco', false );
		pll_register_string( 'creditterms', 'Credit Terms', 'kafco', false );
		pll_register_string( 'defuelfacility', 'Defuel/ Re-issue Facility', 'kafco', false );
		pll_register_string( 'renewaldate', 'Contract Renewal Date', 'kafco', false );

		pll_register_string( 'kwdusd', 'KWD/USD', 'kafco', false );
		pll_register_string( 'prepayment', 'Open / BG / Deposit /Prepayment', 'kafco', false );
		pll_register_string( 'entitlecontract', 'Entitle as per contract /No', 'kafco', false );
		pll_register_string( 'autorenewable', 'Last Date / Auto-renewable', 'kafco', false );

		pll_register_string( 'contractterms', 'Contract Terms', 'kafco', false );
		pll_register_string( 'status', 'Status', 'kafco', false );
		pll_register_string( 'statementaccount', 'Statement Of Account', 'kafco', false );
		pll_register_string( 'upliftsummary', 'Fuel Uplift Summary', 'kafco', false );
		pll_register_string( 'fuelprices', 'Fuel Prices', 'kafco', false );
		pll_register_string( 'ticketrequest', 'Missing Fuel Ticket Request', 'kafco', false );
		pll_register_string( 'satisfactionsurvey', 'Satisfaction Survey', 'kafco', false );
		pll_register_string( 'complaints', 'Complaints', 'kafco', false );
		pll_register_string( 'signout', 'Sign out', 'kafco', false );

		pll_register_string( 'contractterms', 'Contract Terms', 'kafco', false );
		pll_register_string( 'datefrom', 'Date from', 'kafco', false );
		pll_register_string( 'dateto', 'Date to', 'kafco', false );
		pll_register_string( 'currency', 'Currency', 'kafco', false );
		pll_register_string( 'applyfilter', 'Apply Filter', 'kafco', false );
		pll_register_string( 'clearfilter', 'Clear Filter', 'kafco', false );

		pll_register_string( 'customer', 'Customer', 'kafco', false );
		pll_register_string( 'yousef', 'Yousef Ali Syed', 'kafco', false );
		pll_register_string( 'openingbalance', 'Opening Balance', 'kafco', false );
		pll_register_string( 'closingbalance', 'Closing Balance', 'kafco', false );
		pll_register_string( 'statementddatefrom', 'Statement Date from', 'kafco', false );
		pll_register_string( 'statementdfromuntil', 'Statement From Until', 'kafco', false );

		pll_register_string( 'serial', 'Serial', 'kafco', false );
		pll_register_string( 'debitnote', 'Debit Note No', 'kafco', false );
		pll_register_string( 'gldatee', 'GL Date', 'kafco', false );
		pll_register_string( 'type', 'Type', 'kafco', false );
		pll_register_string( 'debit', 'Debit', 'kafco', false );
		pll_register_string( 'credit', 'Credit', 'kafco', false );
		pll_register_string( 'runningbalance', 'Running Balance', 'kafco', false );
		pll_register_string( 'comments', 'Comments', 'kafco', false );

		pll_register_string( '16jul23', '16-jul-23', 'kafco', false );
		pll_register_string( 'banktransfer', 'NBK Bank Transfer', 'kafco', false );
		pll_register_string( 'kwd', 'KWD', 'kafco', false );
		pll_register_string( 'onaccount', 'On Account', 'kafco', false );

		pll_register_string( 'totalcredit', 'Total Credit', 'kafco', false );
		pll_register_string( 'runningbalance', 'Total Running Balance', 'kafco', false );
		pll_register_string( 'summary', 'Summary', 'kafco', false );
		pll_register_string( 'customername', 'Customer Name', 'kafco', false );
		pll_register_string( 'totalbalance', 'Total Balance', 'kafco', false );
		pll_register_string( 'download', 'Download', 'kafco', false );

		pll_register_string( 'ticketrequest', 'Missing Fuel Ticket Request', 'kafco', false );
		pll_register_string( 'providedetails', 'Please provide the following details', 'kafco', false );
		pll_register_string( 'dateuplift', 'Date of Uplift', 'kafco', false );
		pll_register_string( 'flightnumber', 'Flight Number', 'kafco', false );
		pll_register_string( 'registrationnumber', 'Flight Registration Number', 'kafco', false );
		pll_register_string( 'airlinescustomername', 'Airlines/Customer Name', 'kafco', false );
		pll_register_string( 'refnumber', 'Fuel Release Referance Number', 'kafco', false );
		pll_register_string( 'submitrequest', 'Submit Request', 'kafco', false );
		pll_register_string( 'note', 'Note: Above request will be forwarded to Ops. Department and C.C to Sales & Customer Sales', 'kafco', false );

		pll_register_string( 'name', 'Name', 'kafco', false );
		pll_register_string( 'email', 'Email', 'kafco', false );
		pll_register_string( 'jobtitle', 'Job Title', 'kafco', false );
		pll_register_string( 'company', 'Company', 'kafco', false );
		pll_register_string( 'phone', 'Phone', 'kafco', false );
		pll_register_string( 'country', 'Country', 'kafco', false );
		pll_register_string( 'mobile', 'Mobile', 'kafco', false );
		pll_register_string( 'subject', 'Subject', 'kafco', false );
		pll_register_string( 'salescomplaint', 'Sales related complaint', 'kafco', false );
		pll_register_string( 'message', 'Message', 'kafco', false );
		
		
		
		//pll_register_string( 'aidprovided', 'THE AID PROVIDED IS TOTAL', 'arab-funds', false );
		//pll_register_string( 'privatesector', 'PRIVATE SECTOR', 'arab-funds', false );
	}


	/**
	 * Adding Hooks
	 *
	 * @package Kafco
	 * @since 1.0.0
	 */
	function add_hooks(){
		add_action('plugins_loaded', array($this,'kafco_load_all_translation_strings'));
	}
}
?>