<?php
/*
 * Title: car service class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class CarServicesBankingDetails extends Form {
     var $formDescription =
            array(
                'fields'     =>
                    array(
                        array(
                            'name'					=> 'id',
                            'type'                	=> fldIdentity,
                            'display'            	=>
                                array(
                                    'show'        	=> true,
                                    'insert'    	=> false,
                                    'view'        	=> true,
                                    'update'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                	=> 'car_services_banking_details'),
                    	array(
							'name'				=> 'car_services_id',
							'description'		=> 'СТО',
					        'type'				=> fldHidden,
							'display'			=>
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'car_services_banking_details'),
                        array(
                            'name'                	=> 'bank',
                            'description'        	=> 'Банк',
                            'type'                	=> fldText,
							'maxlength'				=> 50,
                            'display'            	=>
                                array(
                                    'show'        	=> true,
                                    'insert'    	=> true,
                                    'view'        	=> true,
                                    'update'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        	=> 2,
                            'table'                	=> 'car_services_banking_details'),
                        array(
                            'name'                	=> 'bank_mfo',
                            'description'        	=> 'МФО банка',
                            'type'                	=> fldText,
							'maxlength'				=> 6,
							'validationRule'		=> '^([0-9]{6})$',
                            'display'            	=>
                                array(
                                    'show'        	=> false,
                                    'insert'    	=> true,
                                    'view'        	=> true,
                                    'update'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        	=> 3,
                            'table'                	=> 'car_services_banking_details'),
                         array(
                            'name'                	=> 'bank_edrpou',
                            'description'        	=> 'ЄДРПОУ банка',
                            'type'                	=> fldText,
							'maxlength'				=> 8,
							'validationRule'		=> '^([0-9]{8})$',
                            'display'            	=>
                                array(
                                    'show'        	=> true,
                                    'insert'    	=> true,
                                    'view'        	=> true,
                                    'update'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        	=> 4,
                            'table'                	=> 'car_services_banking_details'),
                        array(
                            'name'                	=> 'bank_account',
                            'description'        	=> 'Розрахунковий рахунок',
                            'type'                	=> fldText,
							'maxlength'				=> 14,
							'validationRule'		=> '^([0-9]{6,14})$',
                            'display'            	=>
                                array(
                                    'show'        	=> true,
                                    'insert'    	=> true,
                                    'view'        	=> true,
                                    'update'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        	=> 1,
                            'table'                	=> 'car_services_banking_details'),                                
                        array(
                            'name'                	=> 'created',
                            'description'        	=> 'Створено',
                            'type'                	=> fldDate,
                            'value'                	=> 'NOW()',
                            'display'            	=>
                                array(
                                    'show'        	=> true,
                                    'insert'    	=> false,
                                    'view'        	=> false,
                                    'update'    	=> false
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        	=> 5,
                            'table'                	=> 'car_services_banking_details'),
                        array(
                            'name'                	=> 'modified',
                            'description'        	=> 'Редаговано',
                            'type'                	=> fldDate,
                            'value'                	=> 'NOW()',
                            'display'            	=>
                                array(
                                    'show'        	=> true,
                                    'insert'    	=> false,
                                    'view'        	=> false,
                                    'update'    	=> false
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        	=> 6,
                            'width'                	=> 100,
                            'table'                	=> 'car_services_banking_details')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'car_services_id'
                    )
            );
     function CarServicesBankingDetails($data) {
        Form::Form($data);

        $this->messages['plural'] = 'Реквізити СТО';
        $this->messages['single'] = 'Реквізити СТО';

    }
    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'    	=> true,
                    'insert'    => true,
                    'update'   	=> true,
                    'view'    	=> true,
                    'change'    => true,
                    'delete'    => true,
                    'export'    => true);
                break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				break;
        }
    }

}
?>