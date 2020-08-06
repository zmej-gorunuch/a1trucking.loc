<?php

namespace controller;

use core\Controller;
use core\Input;
use core\Mail;
use core\Url;
use Exception;

/**
 * Class MainController
 *
 * @package app\controller
 * @author Mazuryk Eugene
 */
class MainController extends Controller {
	/**
	 * Головна сторінка
	 *
	 * @throws Exception
	 */
	public function indexAction() {
		$text = 'Це початковий PHP каркас, призначений для створення веб-ресурсів.';
		$this->render( 'home', compact( 'text' ) );
	}

	/**
	 * Сторінка політики конфіденційності
	 *
	 * @throws Exception
	 */
	public function privacyAction() {
		$this->render( 'privacy' );
	}

	/**
	 * Сторінка cookie
	 *
	 * @throws Exception
	 */
	public function cookieAction() {
		$this->render( 'cookie' );
	}

	/**
	 * Сторінка terms & conditions
	 *
	 * @throws Exception
	 */
	public function termsConditionsAction() {
		$this->render( 'terms' );
	}

	/**
	 * Сторінка форми
	 *
	 * @throws Exception
	 */
	public function formAction() {
		$this->render( 'form' );
	}

	/**
	 * Відправлення пошти
	 */
	public function sendMailAction() {
		if ( $_POST ) {
			$formCleaner = new Input();

			// Name
			$name_data = $_POST['name'];
			if ( $name_data ) {
				$name = $formCleaner::str( $name_data );
			} else {
				$name = null;
			}
			// Company name
			$company_name_data = $_POST['company'];
			if ( $company_name_data ) {
				$company_name = $formCleaner::str( $company_name_data );
			} else {
				$company_name = null;
			}
			// Email
			$email_data = $_POST['email'];
			if ( $email_data ) {
				$email = $formCleaner::str( $email_data );
			} else {
				$email = null;
			}
			// Phone
			$mob_code_data = $_POST['mob-code'];
			$phone_data    = $_POST['phone'];
			if ( $mob_code_data && $phone_data ) {
				$phone = $formCleaner::str( $mob_code_data ) . ' '
				         . $formCleaner::str( $phone_data );
			} else {
				$phone = null;
			}
			// Location
			$location_data = $_POST['country'];
			if ( $location_data ) {
				$location = $formCleaner::str( $location_data );
			} else {
				$location = null;
			}
			// My experience
			$experience_data = $_POST['exp-card'];
			if ( $experience_data ) {
				$experience = $formCleaner::str( $experience_data );
			} else {
				$experience = null;
			}
			// Engagement model
			$engagement_model_data = $_POST['eng-list'];
			if ( $engagement_model_data ) {
				$engagement_model = $formCleaner::str( $engagement_model_data );
			} else {
				$engagement_model = null;
			}
			// Pricing model
			$pricing_model_data = $_POST['payment'];
			if ( $pricing_model_data ) {
				$pricing_model = $formCleaner::str( $pricing_model_data );
			} else {
				$pricing_model = null;
			}
			// Acceptable Rate
			$acceptable_rate_data = $_POST['paymentSecond'];
			if ( $acceptable_rate_data ) {
				$acceptable_rate = $formCleaner::str( $acceptable_rate_data );
			} else {
				$acceptable_rate = null;
			}
			// MUST BE criteria
			$must_be_criteria_data = $_POST['mustBe'];
			if ( $must_be_criteria_data ) {
				$must_be_criteria = $formCleaner::text( $must_be_criteria_data );
			} else {
				$must_be_criteria = null;
			}
			// Estimated involvement duration in project
			$duration_in_project_data = $_POST['estimate'];
			if ( $duration_in_project_data ) {
				$duration_in_project = $formCleaner::str( $duration_in_project_data );
			} else {
				$duration_in_project = null;
			}
			// Start day
			$start_day_data = $_POST['foo'];
			if ( $start_day_data ) {
				$start_day_data = $formCleaner::time( $start_day_data );
				$start_day      = date( 'd/m', $start_day_data );
			} else {
				$start_day = null;
			}
			// What are you building?
			$what_building_data = $_POST['build-list'];
			if ( $what_building_data ) {
				$what_building = $formCleaner::str( $what_building_data );
			} else {
				$what_building = null;
			}
			// My Product related to
			$product_related_data = $_POST['myProduct'];
			if ( $product_related_data ) {
				$product_related = $formCleaner::str( $product_related_data );
			} else {
				$product_related = null;
			}
			// Short brief
			$short_brief_data = $_POST['benefit-p'];
			if ( $short_brief_data ) {
				$short_brief = $formCleaner::str( $short_brief_data );
			} else {
				$short_brief = null;
			}
			// Developers
			$developers = [];
			for ( $i = 0; ! empty( $_POST[ $i . '_req_dev' ] ); $i ++ ) {
				$developers[] = [
					'developer'        => $_POST[ $i . '_req_dev' ],
					'level'            => $_POST[ $i . '_req_level' ],
					'quantity'         => $_POST[ $i . '_req_quantity' ],
					'technology_stack' => $_POST[ $i . '_req_technology' ],
					'experience_min'   => $_POST[ $i . '_req_experience' ],
					'workload'         => $_POST[ $i . '_req_workload' ],
					'contract_basis'   => $_POST[ $i . '_req_contract' ],
					'work_location'    => $_POST[ $i . '_req_work' ],
					'english'          => $_POST[ $i . '_req_englis' ],
				];
			}

			if ( $developers ) {
				$developersTable = '';
				$number          = 1;
				foreach ( $developers as $developer ) {

					$developersTable .= '<tr>';
					$developersTable .= '<td colspan="2"><b>Developer - ' . $number . '</b></td>';
					$developersTable .= '</tr>';

					$developersTable .= '<tr>';
					$developersTable .= '<td>Developer</td>';
					$developersTable .= '<td>' . $developer['developer'] . '</td>';
					$developersTable .= '</tr>';

					$developersTable .= '<tr>';
					$developersTable .= '<td>Level</td>';
					$developersTable .= '<td>' . $developer['level'] . '</td>';
					$developersTable .= '</tr>';

					$developersTable .= '<tr>';
					$developersTable .= '<td>Quantity</td>';
					$developersTable .= '<td>' . $developer['quantity'] . '</td>';
					$developersTable .= '</tr>';

					$developersTable .= '<tr>';
					$developersTable .= '<td>Technology Stack</td>';
					$developersTable .= '<td>' . $developer['technology_stack'] . '</td>';
					$developersTable .= '</tr>';

					$developersTable .= '<tr>';
					$developersTable .= '<td>Experience Min</td>';
					$developersTable .= '<td>' . $developer['experience_min'] . '</td>';
					$developersTable .= '</tr>';

					$developersTable .= '<tr>';
					$developersTable .= '<td>Workload</td>';
					$developersTable .= '<td>' . $developer['workload'] . '</td>';
					$developersTable .= '</tr>';

					$developersTable .= '<tr>';
					$developersTable .= '<td>Contract Basis</td>';
					$developersTable .= '<td>' . $developer['contract_basis'] . '</td>';
					$developersTable .= '</tr>';

					$developersTable .= '<tr>';
					$developersTable .= '<td>Work Location</td>';
					$developersTable .= '<td>' . $developer['work_location'] . '</td>';
					$developersTable .= '</tr>';

					$developersTable .= '<tr>';
					$developersTable .= '<td>English</td>';
					$developersTable .= '<td>' . $developer['english'] . '</td>';
					$developersTable .= '</tr>';
					$number ++;
				}
			} else {
				if ( ! empty( 'req-or' ) ) {
					$developersTable = '<tr><td colspan="2"><b>NOT SURE who I need</b></td></tr>';
				} else {
					$developersTable = null;
				}
			}

			// Відправка листа
			$mail = new Mail();

			$mail->to( $email, $name );
			$mail->from( 'mail@universedev.i', 'UniverseDev' );
			$mail->subject = 'Form from the site ' . substr( strrchr( Url::home(),
					'://' ), 3 );
			$mail->SMTPHost( 'ssl://smtp.gmail.com' );
			$mail->SMTPUsername( 'mail@universedev.io' );
			$mail->SMTPPassword( 'P5pPK7sw' );
			$mail->SMTPPort( 465 );
			$mail->body = '
			<table>
	            <tbody>
	                <tr>
	                    <td>Name</td>
	                    <td>' . $name . '</td>
	                </tr>
	                <tr>
	                    <td>Company name</td>
	                    <td>' . $company_name . '</td>
	                </tr>
	                <tr>
	                    <td>Email</td>
	                    <td>' . $email . '</td>
	                </tr>
	                <tr>
	                    <td>Phone</td>
	                    <td>' . $phone . '</td>
	                </tr>
	                <tr>
	                    <td>Location</td>
	                    <td>' . $location . '</td>
	                </tr>
	                <tr>
	                    <td>My experience</td>
	                    <td>' . $experience . '</td>
	                </tr>
	                <tr>
	                    <td>Engagement model:</td>
	                    <td>' . $engagement_model . '</td>
	                </tr>
	                <tr>
	                    <td>Pricing model:</td>
	                    <td>' . $pricing_model . '</td>
	                </tr>
	                <tr>
	                    <td>Acceptable Rate:</td>
	                    <td>' . $acceptable_rate . '</td>
	                </tr>
	                <tr>
	                    <td>"MUST BE criterias"</td>
	                    <td>' . $must_be_criteria . '</td>
	                </tr>
	                <tr>
	                    <td>Estimated involvement duration in project</td>
	                    <td>' . $duration_in_project . '</td>
	                </tr>
	                <tr>
	                    <td>Start day</td>
	                    <td>' . $start_day . '</td>
	                </tr>
	                <tr>
	                    <td>What are you building?</td>
	                    <td>' . $what_building . '</td>
	                </tr>
	                <tr>
	                    <td>My Product related to</td>
	                    <td>' . $product_related . '</td>
	                </tr>
	                <tr>
	                    <td>Short brief </td>
	                    <td>' . $short_brief . '</td>
	                </tr>
	                ' . $developersTable . '
	            </tbody>
	        </table>';

			if ( $mail->sendSMTP() ) {
				Url::redirect();
			} else {
				header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found' );
				require( 'app/view/404.php' );
			}
		} else {
			header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found' );
			require( 'app/view/404.php' );
		}
	}
}
