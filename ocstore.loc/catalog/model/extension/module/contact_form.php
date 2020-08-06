<?php

class ModelExtensionModuleContactForm extends Model {
	public function addContactForm( $data ) {
		if ( $this->db->query( "INSERT INTO " . DB_PREFIX . "contact_form (contact_form_email, contact_form_name, contact_form_phone, contact_form_message, contact_form_date) values ('" . $this->db->escape( $data['email'] ) . "', '" . $this->db->escape( $data['name'] ) . "', '" . $this->db->escape( $data['phone'] ) . "', '" . $this->db->escape( $data['message'] ) . "', NOW())" ) ) {
			return true;
		} else {
			return false;
		}
	}
}
