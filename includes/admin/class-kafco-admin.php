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
		pll_register_string( 'invoiceamount', 'Invoice Amount', 'kafco', false );
		pll_register_string( 'duedate', 'Due Date', 'kafco', false );
		pll_register_string( 'dateofissue', 'Date of Issue', 'kafco', false );
		pll_register_string( 'invoiceid', 'Invoice #', 'kafco', false );
		pll_register_string( 'fuelupliftsummary', 'Fuel Uplift Summary', 'kafco', false );
		pll_register_string( 'fuelticket', 'Fuel Ticket No.', 'kafco', false );
		pll_register_string( 'qtyltrs', 'Quantity(Ltrs)', 'kafco', false );
		pll_register_string( 'flight#', 'Flight#', 'kafco', false );
		pll_register_string( 'aircraftreg#', 'Aircraft Reg.#', 'kafco', false );



		pll_register_string( 'fuelpriceffdt', 'Fuel Price Effective Date (dd/mm/yyyy)', 'kafco', false );
		pll_register_string( 'validuntdt', 'Valid Until Date (dd/mm/yyyy)', 'kafco', false );
		pll_register_string( 'filsltr', 'Fils/Ltr', 'kafco', false );
		pll_register_string( 'uscusg', 'USC/USG', 'kafco', false );
		pll_register_string( 'exchangerate', 'Exchange Rate', 'kafco', false );
		pll_register_string( 'operationalsurvey', 'Operational Satisfaction Survey', 'kafco', false );
		pll_register_string( 'commercialsurvey', 'Commercial Satisfaction Survey', 'kafco', false );

		
		
		
		//pll_register_string( 'aidprovided', 'THE AID PROVIDED IS TOTAL', 'arab-funds', false );
		//pll_register_string( 'privatesector', 'PRIVATE SECTOR', 'arab-funds', false );
	}

	/**
	 * Admin Class
	 *
	 * Custom method to show customer id field in back-end of users level.
	 *
	 * @package Kafco
	 * @since 1.0.0
	*/

    public function kafco_show_extra_fields( $user ) {

		$user_id = $user->ID;
		$customer_id = !empty( get_user_meta( $user_id , 'custom_user_id' , true)) ? get_user_meta( $user_id , 'custom_user_id' , true) : "";

		?>
		<h3><?php _e("Extra User Information", "blank"); ?></h3>
		<table class="form-table">
			<tr>
				<th><label for="customerid"><?php _e("Customer Id"); ?></label></th>
				<td>
					<input type="text" name="customerid" id="customerid" value="<?php echo $customer_id; ?>" class="regular-text" disabled="disabled" />
				</td>
			</tr>
		</table>
		<?php
	}

	/**
	 * Admin Class
	 *
	 * Custom code to disable admin bar if user logged-in of subscriber role
	 *
	 * @package Kafco
	 * @since 1.0.0
	*/

	public function kafco_disable_admin_bar() {
		
		if (is_user_logged_in()) {
			$user = wp_get_current_user();	
			if (in_array('subscriber', $user->roles)) {		
				show_admin_bar(false);
			}
		}
	}

	/**
	 * Adding Hooks
	 *
	 * @package Kafco
	 * @since 1.0.0
	 */
	function add_hooks(){
		add_action('plugins_loaded', array($this,'kafco_load_all_translation_strings'));
		add_action('show_user_profile', array($this,'kafco_show_extra_fields'));
        add_action('edit_user_profile', array($this,'kafco_show_extra_fields'));
		add_action('after_setup_theme', array($this,'kafco_disable_admin_bar'));
	}
}
?>