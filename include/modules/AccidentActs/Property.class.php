<?
/*
 * Title: accident acts class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Accidents.class.php';
require_once 'AccidentActs.class.php';
require_once 'AccidentMessages.class.php';
require_once 'AccidentDocuments.class.php';
require_once 'AccidentPaymentsCalendar.class.php';
require_once 'BankDay.php';

class AccidentActs_Property extends AccidentActs {

	var $formDescription =
		array(
			'fields'     =>
				array(
					array(
						'name'					=> 'id',
						'type'              	=> fldIdentity,
						'display'           	=>
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
						'table'             	=> 'accidents_acts'),
					array(
						'name'                  => 'accidents_id',
						'description'           => 'Випадок',
						'type'                  => fldHidden,
						'display'               =>
							array(
								'show'          => true,
								'insert'        => true,
								'view'          => true,
								'update'        => true
							),
						'verification'          =>
							array(
								'canBeEmpty'    => false
							),
						'orderPosition'         => -1,
						'table'                 => 'accidents_acts'),
                    array(
						'name'                  => 'product_types_id',
						'description'           => 'Тип продукту',
						'type'                  => fldHidden,
						'display'               =>
							array(
								'show'          => false,
								'insert'        => true,
								'view'          => false,
								'update'        => false
							),
						'verification'          =>
							array(
								'canBeEmpty'    => false
							),
						'table'                 => 'accidents_acts'),
					array(
						'name'                	=> 'number',
						'description'        	=> 'Номер',
						'type'                	=> fldText,
						'maxlength'			 	=> 30,
						'display'            	=>
							array(
								'show'        	=> true,
								'insert'    	=> true,
								'view'        	=> true,
								'update'    	=> false
							),
						'verification'        	=>
							array(
								'canBeEmpty'    => true
							),
						'orderPosition'			=> 1,
						'table'                	=> 'accidents_acts'),
					/*array(
						'name'                	=> 'deterioration_value',
						'description'        	=> 'Коефіцієнт зносу',
						'type'                	=> fldPercent,
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
						'table'                	=> 'accidents_property_acts'),*/
					/*array(
						'name'                	=> 'deterioration_basis',
						'description'        	=> 'Коефіцієнт зносу, згідно',
						'type'                	=> fldText,
						'maxlength'				=> 100,
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
						'table'                	=> 'accidents_property_acts'),*/
					array(
						'name'                	=> 'payment_document_number',
						'description'        	=> 'Згідно, номер',
						'type'                	=> fldText,
						'maxlength'				=> 50,
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
						'table'                	=> 'accidents_acts'),
					array(
						'name'                	=> 'payment_document_date',
						'description'        	=> 'Згідно, дата',
						'type'                	=> fldDate,
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
						'table'                	=> 'accidents_acts'),
					/*array(
						'name'                	=> 'amount_details',
						'description'        	=> 'Вартість запчастин, грн.',
						'type'                	=> fldMoney,
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
						'table'                	=> 'accidents_property_acts'),*/
					/*array(
						'name'                	=> 'amount_material',
						'description'       	=> 'Вартість матеріалів, грн.',
						'type'                	=> fldMoney,
						'display'           	=>
							array(
								'show'        	=> false,
								'insert'    	=> true,
								'view'       	=> true,
								'update'    	=> true
							),
						'verification'        	=>
							array(
								'canBeEmpty'    => false
							),
						'table'                	=> 'accidents_property_acts'),*/
					/*array(
						'name'                	=> 'amount_work',
						'description'        	=> 'Вартість робіт, грн.',
						'type'               	=> fldMoney,
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
						'table'                	=> 'accidents_property_acts'),*/
					/*array(
						'name'                	=> 'amount_expertize',
						'description'        	=> 'Вартість експертизи, грн.',
						'type'                	=> fldMoney,
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
						'orderPosition'			=> 3,
						'table'                	=> 'accidents_property_acts'),*/
					/*array(
						'name'                	=> 'amount_evacuate',
						'description'        	=> 'Вартість транспортування, грн.',
						'type'                	=> fldMoney,
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
						'orderPosition'			=> 4,
						'table'                	=> 'accidents_property_acts'),*/
					array(
						'name'                	=> 'amount_compensation',
						'description'        	=> 'Евакуатор, грн.',
						'type'                	=> fldMoney,
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
						'orderPosition'			=> 5,
						'table'                	=> 'accidents_property_acts'),
					array(
						'name'                	=> 'amount',
						'description'        	=> 'Сума відшкодування, грн.',
						'type'                	=> fldMoney,
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
						'orderPosition'			=> 2,
						'table'                	=> 'accidents_acts'),
					array(
						'name'                	=> 'documents',
						'description'        	=> 'Документи',
						'type'                	=> fldText,
						'display'            	=>
							array(
								'show'        	=> false,
								'insert'    	=> true,
								'view'        	=> true,
								'update'    	=> false
							),
						'verification'        	=>
							array(
								'canBeEmpty'    => true
							),
						'table'                	=> 'accidents_acts'),
					array(
						'name'                  => 'estimate_managers_id',
						'description'           => 'Експерт',
						'type'                  => fldSelect,
						'display'               =>
							array(
								'show'          => true,
								'insert'        => true,
								'view'          => false,
								'update'        => true
							),
						'verification'          =>
							array(
								'canBeEmpty'    => false
							),
						'orderPosition'         => 6,
						'table'             	=> 'accidents_acts',
						'sourceTable'       	=> 'accounts',
						'selectField'       	=> 'lastname',
						'orderField'        	=> 'id'),
					array(
						'name'                  => 'average_managers_id',
						'description'           => 'Аварком',
						'type'                  => fldSelect,
						'display'               =>
							array(
								'show'          => false,
								'insert'        => true,
								'view'          => false,
								'update'        => true
							),
						'verification'          =>
							array(
								'canBeEmpty'    => false
							),
						'table'             	=> 'accidents_acts',
						'sourceTable'       	=> 'accounts',
						'selectField'       	=> 'lastname',
						'orderField'        	=> 'id'),
					array(
						'name'                  => 'act_statuses_id',
						'description'           => 'Статус',
						'type'                  => fldSelect,
						'display'               =>
							array(
								'show'          => true,
								'insert'        => true,
								'view'          => false,
								'update'        => true
							),
						'verification'          =>
							array(
								'canBeEmpty'    => false
							),
						'orderPosition'			=> 7,
						'table'             	=> 'accidents_acts',
						'sourceTable'       	=> 'accident_statuses',
						'selectField'       	=> 'title',
						'orderField'        	=> 'order_position'),
					array(
						'name'                  => 'payment_statuses_id',
						'description'           => 'Оплата',
						'type'                  => fldSelect,
						'display'               =>
							array(
								'show'          => true,
								'insert'        => true,
								'view'          => false,
								'update'        => false
							),
						'verification'          =>
							array(
								'canBeEmpty'    => false
							),
						'orderPosition'         => 8,
						'table'             	=> 'accidents_acts',
						'sourceTable'       	=> 'payment_statuses',
						'selectField'       	=> 'title',
						'orderField'        	=> 'order_position'),
					array(
						'name'                	=> 'created',
						'description'        	=> 'Створено',
						'type'                	=> fldDate,
						'value'               	=> 'NOW()',
						'display'            	=>
							array(
								'show'        	=> true,
								'insert'    	=> true,
								'view'       	=> false,
								'update'    	=> false
							),
						'verification'        	=>
							array(
								'canBeEmpty'    => false
							),
						'orderPosition'         => 9,
						'table'                	=> 'accidents_acts'),
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
						'orderPosition'			=> 10,
						'table'                	=> 'accidents_acts'),
                    /*array(
                        'name'                	=> 'act_type',
                        'description'        	=> 'Тип акта',
                        'type'                	=> fldInteger,
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
                        'width'				    => 100,
                        'table'                	=> 'accidents_acts'),*/					
				),
			'common'    =>
				array(
					'defaultOrderPosition'    	=> 10,
					'defaultOrderDirection'    	=> 'desc',
					'titleField'            	=> 'created'
				)
		);

	var $investigationFormDescription =
		array(
			'fields'     =>
				array(
					array(
						'name'					=> 'id',
						'type'              	=> fldIdentity,
						'display'           	=>
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
						'table'             	=> 'accidents_acts'),
					array(
						'name'                  => 'accidents_id',
						'description'           => 'Випадок',
						'type'                  => fldHidden,
						'display'               =>
							array(
								'show'          => true,
								'insert'        => true,
								'view'          => true,
								'update'        => true
							),
						'verification'          =>
							array(
								'canBeEmpty'    => false
							),
						'orderPosition'         => -1,
						'table'                 => 'accidents_acts'),
                     array(
						'name'                  => 'product_types_id',
						'description'           => 'Тип продукту',
						'type'                  => fldHidden,
						'display'               =>
							array(
								'show'          => false,
								'insert'        => true,
								'view'          => false,
								'update'        => false
							),
						'verification'          =>
							array(
								'canBeEmpty'    => false
							),
						'table'                 => 'accidents_acts'),
					array(
						'name'                	=> 'number',
						'description'        	=> 'Номер',
						'type'                	=> fldText,
						'maxlength'			 	=> 30,
						'display'            	=>
							array(
								'show'        	=> true,
								'insert'    	=> false,
								'view'        	=> true,
								'update'    	=> false
							),
						'verification'        	=>
							array(
								'canBeEmpty'    => false
							),
						'orderPosition'			=> 1,
						'table'                	=> 'accidents_acts'),
					array(
						'name'                	=> 'insurance',
						'description'        	=> 'Випадок1',
						'type'              	=> fldInteger,
						'list'					=> array(
													1 => 'Страховий, з виплатою',
													2 => 'Страховий, без виплати',
													3 => 'Не страховий'),
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
						'table'                	=> 'accidents_acts'),
					/*array(
						'name'                	=> 'deterioration_value',
						'description'        	=> 'Коефіцієнт зносу',
						'type'                	=> fldPercent,
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
						'table'                	=> 'accidents_property_acts'),*/
					array(
						'name'					=> 'deductibles_amount',
						'description'			=> 'Франшиза, грн.',
						'type'					=> fldMoney,
						'display'				=> 
							array(
								'show'			=> false,
								'insert'		=> true,
								'view'			=> true,
								'update'		=> true
							),
						'verification'			=>
							array(
								'canBeEmpty'	=> false
							),
						'table'					=> 'accidents_property_acts'),
					array(
						'name'					=> 'deductibles_change',
						'description'			=> 'Франшиза змінена',
						'type'					=> fldBoolean,
						'display'				=> 
							array(
								'show'			=> false,
								'insert'		=> true,
								'view'			=> true,
								'update'		=> true
							),
						'verification'			=>
							array(
								'canBeEmpty'	=> true
							),
						'table'					=> 'accidents_property_acts'),
					array(
						'name'                	=> 'payment_document_number',
						'description'        	=> 'Згідно, номер',
						'type'                	=> fldText,
						'maxlength'				=> 50,
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
						'table'                	=> 'accidents_acts'),
					array(
						'name'                	=> 'payment_document_date',
						'description'        	=> 'Згідно, дата',
						'type'                	=> fldDate,
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
						'table'                	=> 'accidents_acts'),
					/*array(
						'name'                	=> 'amount_details',
						'description'        	=> 'Вартість запчастин, грн.',
						'type'                	=> fldMoney,
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
						'table'                	=> 'accidents_property_acts'),*/
					/*array(
						'name'                	=> 'amount_material',
						'description'       	=> 'Вартість матеріалів, грн.',
						'type'                	=> fldMoney,
						'display'           	=>
							array(
								'show'        	=> false,
								'insert'    	=> true,
								'view'       	=> true,
								'update'    	=> true
							),
						'verification'        	=>
							array(
								'canBeEmpty'    => false
							),
						'table'                	=> 'accidents_property_acts'),*/
					/*array(
						'name'                	=> 'amount_work',
						'description'        	=> 'Вартість робіт, грн.',
						'type'               	=> fldMoney,
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
						'table'                	=> 'accidents_property_acts'),*/
                    array(
						'name'                	=> 'discount',
						'description'        	=> 'Знижка, грн.',
						'type'                	=> fldMoney,
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
						'table'                	=> 'accidents_property_acts'),
					array(
						'name'                	=> 'discount_basis',
						'description'        	=> 'Знижка, згідно',
						'type'                	=> fldText,
						'maxlength'			 	=> 100,
						'display'            	=>
							array(
								'show'        	=> false,
								'insert'    	=> true,
								'view'        	=> true,
								'update'    	=> true
							),
						'verification'        	=>
							array(
								'canBeEmpty'    => true
							),
						'table'                	=> 'accidents_property_acts'),
					array(
						'name'                	=> 'amount',
						'description'        	=> 'Сума відшкодування, грн.',
						'type'                	=> fldMoney,
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
						'orderPosition'			=> 2,
						'table'                	=> 'accidents_acts'),
					/*array(
						'name'                	=> 'amount_expertize',
						'description'        	=> 'Вартість експертизи, грн.',
						'type'                	=> fldMoney,
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
						'orderPosition'			=> 3,
						'table'                	=> 'accidents_property_acts'),*/
					/*array(
						'name'                	=> 'amount_evacuate',
						'description'        	=> 'Вартість транспортування, грн.',
						'type'                	=> fldMoney,
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
						'orderPosition'			=> 4,
						'table'                	=> 'accidents_property_acts'),*/
					array(
						'name'                	=> 'amount_start',
						'description'        	=> 'Розмір заподіяної шкоди, грн.',
						'type'                	=> fldMoney,
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
						'orderPosition'			=> 5,
						'table'                	=> 'accidents_property_acts'),
                    array(
						'name'                	=> 'amount_others',
						'description'        	=> 'Додаткові витрати, грн.',
						'type'                	=> fldMoney,
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
						'orderPosition'			=> 5,
						'table'                	=> 'accidents_property_acts'),
					array(
						'name'                	=> 'documents',
						'description'        	=> 'Документи',
						'type'                	=> fldText,
						'display'            	=>
							array(
								'show'        	=> false,
								'insert'    	=> true,
								'view'        	=> true,
								'update'    	=> true
							),
						'verification'        	=>
							array(
								'canBeEmpty'    => true
							),
						'table'                	=> 'accidents_acts'),
					/*array(
						'name'                  => 'average_managers_id',
						'description'           => 'Аварком',
						'type'                  => fldHidden,
						'display'               =>
							array(
								'show'          => true,
								'insert'        => true,
								'view'          => false,
								'update'        => true
							),
						'verification'          =>
							array(
								'canBeEmpty'    => false
							),
						'orderPosition'         => 5,
						'table'             	=> 'accidents_acts',
						'sourceTable'       	=> 'accounts',
						'selectField'       	=> 'lastname',
						'orderField'        	=> 'id'),*/
					array(
						'name'                  => 'act_statuses_id',
						'description'           => 'Статус',
						'type'                  => fldSelect,
						'display'               =>
							array(
								'show'          => true,
								'insert'        => true,
								'view'          => false,
								'update'        => true
							),
						'verification'          =>
							array(
								'canBeEmpty'    => false
							),
						'orderPosition'         => 6,
						'table'             	=> 'accidents_acts',
						'sourceTable'       	=> 'accident_statuses',
						'selectField'       	=> 'title',
						'orderField'        	=> 'order_position'),
					array(
						'name'                  => 'documents_date',
						'description'           => 'Дата отримання останнього документу',
						'type'                  => fldDate,
						'display'               =>
							array(
								'show'          => false,
								'insert'        => true,
								'view'          => true,
								'update'        => true
							),
						'verification'          =>
							array(
								'canBeEmpty'    => false
							),
						'table'             	=> 'accidents_acts'),
					array(
						'name'                  => 'approval_term',
						'description'           => 'Кількість робочих днів на прийняття рішення',
						'type'                  => fldInteger,
						'display'               =>
							array(
								'show'          => false,
								'insert'        => true,
								'view'          => true,
								'update'        => true
							),
						'verification'          =>
							array(
								'canBeEmpty'    => false
							),
						'table'             	=> 'accidents_acts'),
					array(
						'name'                  => 'payment_term',
						'description'           => 'Кількість робочих днів на виплату',
						'type'                  => fldInteger,
						'display'               =>
							array(
								'show'          => false,
								'insert'        => true,
								'view'          => true,
								'update'        => true
							),
						'verification'          =>
							array(
								'canBeEmpty'    => false
							),
						'table'             	=> 'accidents_acts'),
					array(
						'name'                  => 'payment_statuses_id',
						'description'           => 'Оплата',
						'type'                  => fldSelect,
						'display'               =>
							array(
								'show'          => true,
								'insert'        => true,
								'view'          => false,
								'update'        => false
							),
						'verification'          =>
							array(
								'canBeEmpty'    => false
							),
						'orderPosition'         => 7,
						'table'             	=> 'accidents_acts',
						'sourceTable'       	=> 'payment_statuses',
						'selectField'       	=> 'title',
						'orderField'        	=> 'order_position'),
					array(
						'name'                	=> 'created',
						'description'        	=> 'Створено',
						'type'                	=> fldDate,
						'value'               	=> 'NOW()',
						'display'            	=>
							array(
								'show'        	=> true,
								'insert'    	=> false,
								'view'       	=> false,
								'update'    	=> false
							),
						'verification'        	=>
							array(
								'canBeEmpty'    => false
							),
						'orderPosition'			=> 8,
						'table'                	=> 'accidents_acts'),
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
						'orderPosition'			=> 9,
						'table'                	=> 'accidents_acts'),
                    /*array(
                        'name'                	=> 'act_type',
                        'description'        	=> 'Тип акта',
                        'type'                	=> fldInteger,
                        'display'            	=>
                        array(
                            'show'        	=> false,
                            'insert'    	=> true,
                            'view'        	=> true,
                            'update'    	=> true,
                        ),
                        'verification'        	=>
                        array(
                            'canBeEmpty'    => false
                        ),
                        'width'				    => 100,
                        'table'                	=> 'accidents_acts'),*/
					array(
						'name'                	=> 'date',
						'description'        	=> 'Дата затвердження',
						'type'                	=> fldDate,
						'display'            	=>
							array(
								'show'        	=> true,
								'insert'    	=> false,
								'view'        	=> false,
								'update'    	=> false
							),
						'verification'        	=>
							array(
								'canBeEmpty'    => true
							),
						'orderPosition'			=> 11,
						'table'                	=> 'accidents_acts')
				),
			'common'    =>
				array(
					'defaultOrderPosition'    	=> 9,
					'defaultOrderDirection'    	=> 'desc',
					'titleField'            	=> 'created'
				)
		);

        var $approvalFormDescription =
		array(
			'fields'     =>
				array(
					array(
						'name'					=> 'id',
						'type'              	=> fldIdentity,
						'display'           	=>
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
						'table'             	=> 'accidents_acts'),
                    array(
						'name'                  => 'accidents_id',
						'description'           => 'Випадок',
						'type'                  => fldHidden,
						'display'               =>
							array(
								'show'          => true,
								'insert'        => true,
								'view'          => true,
								'update'        => true
							),
						'verification'          =>
							array(
								'canBeEmpty'    => false
							),
						'table'                 => 'accidents_acts'),
					array(
						'name'                  => 'date',
						'description'           => 'Дата',
						'type'                  => fldDate,
                        'value'                 => 'NOW()',
						'display'               =>
							array(
								'show'          => true,
								'insert'        => true,
								'view'          => false,
								'update'        => false
							),
						'verification'          =>
							array(
								'canBeEmpty'    => false
							),
						'table'             	=> 'accidents_acts'),
					array(
						'name'                  => 'act_statuses_id',
						'description'           => 'Статус',
						'type'                  => fldSelect,
						'display'               =>
							array(
								'show'          => true,
								'insert'        => false,
								'view'          => false,
								'update'        => true
							),
						'verification'          =>
							array(
								'canBeEmpty'    => false
							),
						'table'             	=> 'accidents_acts',
						'sourceTable'       	=> 'accident_statuses',
						'selectField'       	=> 'title',
						'orderField'        	=> 'order_position'),
					array(
						'name'                  => 'approval_term',
						'description'           => 'Кількість робочих днів на прийняття рішення',
						'type'                  => fldInteger,
						'display'               =>
							array(
								'show'          => false,
								'insert'        => false,
								'view'          => false,
								'update'        => true
							),
						'verification'          =>
							array(
								'canBeEmpty'    => false
							),
						'table'             	=> 'accidents_acts'),
					array(
						'name'                  => 'payment_term',
						'description'           => 'Кількість робочих днів на виплату',
						'type'                  => fldInteger,
						'display'               =>
							array(
								'show'          => false,
								'insert'        => false,
								'view'          => false,
								'update'        => true
							),
						'verification'          =>
							array(
								'canBeEmpty'    => false
							),
						'table'             	=> 'accidents_acts'),
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
						'table'                	=> 'accidents_acts')
				)
		);

    function AccidentActs_Property($data) {
        AccidentActs::AccidentActs($data);

		$this->messages['plural'] = 'Страхові акти';
		$this->messages['single'] = 'Страховий акт';

		$this->product_types_id = PRODUCT_TYPES_PROPERTY;
    }

	function setFields() {
		foreach ($this->formDescription['fields'] as $i => $field) {
			if ( $field['table'] != 'accidents_acts' && $field['table'] != 'accidents_property_acts') {
				unset($this->formDescription['fields'][ $i ]);
			}
		}
	}

    function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {

		$this->setFields();

		return parent::show($data, $fields, $conditions, $sql, $template, $limit);
	}

	function getPolicyValues($id) {
		global $db;

		$sql =	'SELECT a.policies_id, a.risks_id, a.estimate_managers_id, a.average_managers_id, a.insurance, a.accident_statuses_id, a.comment, a.reason, date_format(a.datetime, ' . $db->quote(DATETIME_FORMAT) . ') as datetime_datetime_format, ' .
				'b.accidents_id, b.address, b.mvs, b.mvs_id, ' .
//				'c.number AS policies_number, date_format(c.date, ' . $db->quote(DATE_FORMAT) . ') AS policies_date_format, date_format(c.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') AS policies_begin_datetime_format, date_format(c.interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') AS policies_interrupt_datetime_format, c.price AS policies_price, c.amount AS policies_amount, ' .
				'c.number AS policies_number, date_format(c.date, ' . $db->quote(DATE_FORMAT) . ') AS policies_date_format, date_format(c.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') AS policies_begin_datetime_format, date_format(c.interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') AS policies_interrupt_datetime_format, c.amount AS price, c.amount as policies_amount, ' .
				'f.value as deductible, f.price as price, f.absolute as deductible_absolute, d.insurer_lastname AS policies_insurer_lastname, d.insurer_firstname AS policies_insurer_firstname, d.insurer_patronymicname AS policies_insurer_patronymicname, d.insurer_identification_code as policies_insurer_identification_code, ' .
                'd.insurer_person_types_id as policies_insurer_person_types_id, d.insurer_company as policies_insurer_company, ' .
				'SUM(g.amount) AS policy_payments_amount ' .
				'FROM ' . PREFIX . '_accidents AS a ' .
				'JOIN ' . PREFIX . '_accidents_property AS b ON a.id = b.accidents_id ' .
				'JOIN ' . PREFIX . '_policies AS c ON a.policies_id = c.id ' .
				'JOIN ' . PREFIX . '_policies_property AS d ON a.policies_id = d.policies_id ' .
                'JOIN ' . PREFIX . '_policies_property_objects AS e ON e.policies_id = a.policies_id ' .
                'JOIN ' . PREFIX . '_policies_property_objects_items AS f ON f.objects_id = e.id ' .
				'LEFT JOIN ' . PREFIX . '_policy_payments AS g ON a.policies_id = g.policies_id ' .
				'WHERE f.id = ' . $this->getItemsIdByAccidentsId(intval($id)) . ' AND a.id = ' . intval($id) . ' ' .
				'GROUP BY g.policies_id';
		$row =	$db->getRow($sql, 30*60);

		$Accidents = Accidents::factory($data, 'Property');

		$row['insurance_price'] = 50000;//($row['policies_options_agregate_no'] == 1) ? $row['policies_price'] : $row['policies_price'] - $Accidents->getAmountPrevious($row['accidents_id']);
		$row['amount_previous_accidents'] = $Accidents->getAmountPrevious($row['accidents_id']);
        //$row['deductibles_amount'] = (($row['deductible_absolute'] == 1) ? $row['deductible'] : round($row['price'] * $row['deductible'] / 100, 2));

		//if ($id == '1986') {
			$row['insurance_price'] = $row['price'];
		//}
        
		return $row;
	}

	function getItemsIdByAccidentsId($accidents_id){
        	global $db;

	        return $db->getOne('SELECT items_id FROM ' . PREFIX . '_accidents_property WHERE accidents_id = ' . $accidents_id);
	}

	//суммы по предыдущим страховым актам
	function getAmountPrevious($accidents_id, $id) {
		global $db;

		$conditions[] = 'accidents_id = ' . intval($accidents_id);

		if (intval($id)) {
			$conditions[] = 'id < ' . intval($id);
		}

		$sql =	'SELECT SUM(amount) ' .
				'FROM ' . PREFIX . '_accidents_acts ' .
				'WHERE ' . implode(' AND ', $conditions);
		$amount = $db->getOne($sql, 30 * 60);

		return ($amount > 0) ? $amount : 0;
	}

	function getPrevious($accidents_id) {
		global $db;

		$fields = array(
			'b.deterioration_value',
			'b.deterioration_basis',
			'b.extent_damage_percent',
			'b.deductibles_amount',
            'b.discount',
            'b.discount_basis'
			);

		$sql =	'SELECT ' . implode(', ', $fields) . ' ' .
				'FROM ' . PREFIX . '_accidents_acts as a ' .
                'JOIN ' . PREFIX . '_accidents_property_acts as b ON a.id = b.accidents_acts_id ' .
				'WHERE a.accidents_id = ' . intval($accidents_id) . ' ' .
				'ORDER BY a.id DESC ' .
				'LIMIT 1';
		return	$db->getRow($sql, 30 * 60);
	}

    function showForm($data, $action, $actionType=null, $template=null) {

		if (is_null($template)) {
			$template = 'propertyInvestigation.php';
		}

		$data['accidents'] = Accidents::factory($data, 'Property');

		$data['accident_statuses_id'] = $data['act_statuses_id'];
		$this->formDescription['fields'][ $this->getFieldPositionByName('act_statuses_id') ]['verification']['canBeEmpty'] = false;
		$this->formDescription['fields'][ $this->getFieldPositionByName('act_statuses_id') ]['list'] = $data['accidents']->getListValue($data['accidents']->formDescription['fields'][ $data['accidents']->getFieldPositionByName('accident_statuses_id') ], $data);

		$data['risks'] = $data['accidents']->getRisks($data['accidents_id']);

        if($data['message_types_id']) {// убираем id из data если акт создается из задачи по Расчету. Так как в функцию подсчета суммы предыдущих актов лезет id задачи.
            unset($data['id']);
        }

		$data['amount_previous_acts'] = $this->getAmountPrevious($data['accidents_id'], $data['id']);
        $data['acts_count'] = $this->getCount($data['accidents_id']);

		if ($data['amount_previous_acts'] > 0) {
			$data = array_merge($data, $this->getPrevious($data['accidents_id']));
		}

        return parent::showForm($data, $action, $actionType, $template);
    }

	function getMVSDocument($accidents_id) {
		global $db;

		$sql =	'SELECT mvs_average, mvs_title_average ' .
				'FROM ' . PREFIX . '_accidents_property ' .
				'WHERE accidents_id = ' . intval($accidents_id);
		$row =	$db->getRow($sql);

		switch ($row['mvs_average']) {
			case '1':
				$result = 'Довідка ' . $row['mvs_title_average'];
				break;
			case '2':
				$result = 'Постанова ' . $row['mvs_title_average'];
				break;
			case '3':
				$result = 'Довідка ' . $row['mvs_title_average'];
				break;
		}

		return $result;
	}

	function add($data) {
        global $db, $Authorization, $Log;

         //запрет создания актов, если есть акты в статусах "Розгляд" или "Затвердження"
        $sql = 'SELECT count(id) ' .
               'FROM ' . PREFIX . '_accidents_acts ' .
               'WHERE  accidents_id = ' . $data['accidents_id'] . ' AND act_statuses_id IN ( ' . ACCIDENT_STATUSES_INVESTIGATION.', ' . ACCIDENT_STATUSES_APPROVAL.', ' . ACCIDENT_STATUSES_COORDINATION . ')';
        //if(intval($db->getOne($sql)) > 0 && $Authorization->data['roles_id'] != ROLES_ADMINISTRATOR) {
		if(intval($db->getOne($sql)) > 0 && $Authorization->data['roles_id'] != ROLES_ADMINISTRATOR || !in_array(Accidents::getAccidentStatusesId($data['accidents_id']), array(ACCIDENT_STATUSES_INVESTIGATION, ACCIDENT_STATUSES_REINVESTIGATION, ACCIDENT_STATUSES_COMPROMISE_CONTINUE))) {
           $this->permissions['insert'] = false;
        }
		
		$sql = 'SELECT compromise, compromise_date ' .
			   'FROM ' . PREFIX . '_accidents ' .
			   'WHERE id = ' . intval($data['accidents_id']);
		$compromise_info = $db->getRow($sql);
		if ($compromise_info['compromise'] == 1 && ($compromise_info['compromise_date'] == NULL || $compromise_info['compromise_date'] == '0000-00-00')) {
			$this->permissions['insert'] = false;
			$Log->add('error', 'Для компромісних справ перед створенням акту потрібно проставити дату рішення');
		}

		$data = array_merge($data, $this->getPolicyValues($data['accidents_id']));
        
		$data['act_statuses_id']		= ACCIDENT_STATUSES_INVESTIGATION;
		$data['deterioration_value']	= ($data['options_deterioration_no'] == '1') ? 0 : $data['deterioration_value'];

		$document = $this->getMVSDocument($data['accidents_id']);

		if ($document != '') {
			$data['document'][] = $document;
		}

		if ($data['insurance'] == 3 && $data['reason']) {
			$data['document'][] = $data['reason'];
		}

		if ($data['deterioration_basis']) {
			$data['document'][] = $data['deterioration_basis'];
		}

        if ($data['payment_document_number']) {
			$data['document'][] = $data['payment_document_number'] . ' від ' . $data['payment_document_date_day'] . '.' . $data['payment_document_date_month'] . '.' . $data['payment_document_date_year'];
        }

		return parent::add($data);
	}

     function load($data, $showForm=true, $action='update', $actionType='update', $template=null) {
        global $db;

        $this->checkPermissions('update', $data);


        if (is_array($data['id'])) $data['id'] = $data['id'][0];

        $this->setTables('load');
        $this->getFormFields('update');

        $identityField = $this->getIdentityField();

        $sql =	'SELECT ' . implode(', ', $this->formFields) . ' ' .
                'FROM ' . $this->tables[0] . ' ' .
                'WHERE ' . PREFIX . '_' . $identityField['table'] . '.' . $identityField['name'] . '=' . intval($data['id']);
        $data = $db->getRow($sql);

        $data = $this->prepareFields($action, $data);

        $data['amount_expertize']		= AccidentPaymentsCalendar::getAmount($data['accidents_id'], PAYMENT_TYPES_EXPERTISE);
		$data['amount_evacuate']		= AccidentPaymentsCalendar::getAmount($data['accidents_id'], PAYMENT_TYPES_EVACUATOR);
        
        if ($showForm) {
            $this->showForm($data, $action, $actionType, $template);
        } else {
            return $data;
        }
      
    }

	function setConstants(&$data) { 
		$data['deductibles'] = $data['deductibles_amount'];
		parent::setConstants($data);
		$data['deductibles_amount'] = $data['deductibles'];
		
		if ($data['do'] == 'AccidentActs|updateApproval') {
			$this->formDescription['fields'][ $this->getFieldPositionByName('approval_term') ]['display']['update'] = false;
			$this->formDescription['fields'][ $this->getFieldPositionByName('payment_term') ]['display']['update'] = false;
		}
		
		if ($data['insurance'] != 1) {
			unset($this->formDescription['fields'][ $this->getFieldPositionByName('payment_term') ]);
		}

        //получаем данные по полису
        $row = $this->getPolicyValues($data['accidents_id'], $data);

        //если случай страховой с выплатой
		if (intval($data['insurance']) == 1) {

			//начало расчета суммы возмещения

			$Accidents = Accidents::factory($data, 'Property');

			$data['amount_previous_accidents'] = $Accidents->getAmountPrevious($data['accidents_id']);

			$data['amount_previous_acts'] = $this->getAmountPrevious($data['accidents_id'], $data['id']);

			//вычисляем сумму страхового возмещения без учета франшизы
			$data['amount'] = $data['amount_start'] - $data['amount_previous_acts'];

            $data['amount'] = round(($data['amount'] - $data['amount_residual'] - $data['deductibles_amount']) * (100 - $data['discount']) / 100, 2);

            if ($data['amount'] < 0) {
				$data['amount'] = 0;
			}
			//конец расчета суммы возмещения
		}
        else {
			$data['amount_compensation']		= 0;
			$data['deterioration_value'] 		= 0;
			$data['deterioration_basis'] 		= '';
			$data['payment_document_number']	= '';
			$data['payment_document_date']		= '';
			$data['amount_details']				= 0;
			$data['amount_material']			= 0;
			$data['amount_work']				= 0;
            $data['discount']			= 0;
			$data['amount']						= 0;
            $data['amount_expertize']           = 0;
            $data['amount_evacuate']            = 0;
			$data['payment_statuses_id']		= PAYMENT_STATUSES_NOT;
            //$data['deductibles_amount']		    = 0;
			
			$data['amount_start'] = 0;
			$data['amount_others'] = 0;
			
			$list = $this->getPolicyValues($data['accidents_id'], $data);
			$data['deductibles_amount'] = $list['price'] * $list['deductible'] / 100;

			$this->formDescription['fields'][ $this->getFieldPositionByName('payment_document_number') ]['verification']['canBeEmpty'] = true;
			$this->formDescription['fields'][ $this->getFieldPositionByName('payment_document_date') ]['verification']['canBeEmpty'] = true;
		}

        $data['act_type'] = (!is_null($data['act_type']) || ($data['amount_previous_acts'] != 0 && $data['insurance'] == 1) || ($data['amount_previous_acts'] == 0 && $data['insurance'] == 1 && $data['acts_count'] != 0)) ? $data['act_type'] : '0';//если не установелно, то присваиваем 0

		if ($data['deterioration_value'] <= 0) {
			$this->formDescription['fields'][ $this->getFieldPositionByName('deterioration_basis') ]['verification']['canBeEmpty'] = true;
		}

		switch (intval($data['mvs_average'])) {
			case 0:
				unset($data['mvs_id_average']);
				$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_id_average') ]['verification']['canBeEmpty'] = true;
				unset($data['mvs_title_average']);
				$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_title_average') ]['verification']['canBeEmpty'] = true;

				unset($data['mvs_date_average_day']);
				unset($data['mvs_date_average_month']);
				unset($data['mvs_date_average_year']);

				$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_date_average') ]['verification']['canBeEmpty'] = true;
				break;
			case 1:
				unset($data['mvs_title']);
				$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_title_average') ]['verification']['canBeEmpty'] = true;
				
				break;
			default:
				unset($data['mvs_id_average']);
				$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_id_average') ]['verification']['canBeEmpty'] = true;
				break;						
		}
	}

	function getPreviousValues($id, $accidents_id) {
		global $db;

		$sql =	'SELECT * ' .
				'FROM ' . PREFIX . '_accidents_acts ' .
				'WHERE accidents_id = ' . intval($accidents_id) . ' AND id <> ' . intval($id) . ' ' .
				'LIMIT 1';
		return $db->getRow($sql);
	}

	function checkFields($data, $action) {
		global $Authorization, $Log;

	    parent::checkFields($data, $action);

        if ($data['do'] != $this->object . '|updateApproval') {
            $previous = $this->getPreviousValues($data['id'], $data['accidents_id']);

			if (is_array($previous)) {
				if ($data['market_price'] != $previous['market_price'] && $previous['amount'] > 0) {
					$Log->add('error', '<b>Ринкова вартість автомобілю</b> не співпадає з ринковою вартістю за попереднім актом.');
				}

				if ($data['proportionality_value'] != $previous['proportionality_value'] && $previous['amount'] > 0) {
					$Log->add('error', '<b>Коефіціент пропорційності</b> не співпадає з коефіціентом пропорційності за попереднім актом.');
				}

				if ($data['deterioration_value'] != $previous['deterioration_value'] && $previous['amount'] > 0) {
					$Log->add('error', '<b>Коефіціент зносу</b> не співпадає з коефіціентом зносу за попереднім актом.');
				}

				if ($data['extent_damage_percent'] != $previous['extent_damage_percent'] && $previous['amount'] > 0) {
					$Log->add('error', '<b>Коефіцієнт тотального збитку</b> не співпадає з коефіцієнтом тотального збитку за попереднім актом.');
				}
            }
			
			//перевірка дати отримання останнього документу
			if (checkdate($data['documents_date_month'], $data['documents_date_day'], intval($data['documents_date_year']))) {
				if (mktime(0, 0, 0, $data['documents_date_month'], $data['documents_date_day'], $data['documents_date_year']) > mktime(0, 0, 0, date('m'), date('d'), date('Y'))) {
					$Log->add('error', '<b>Дата отримання останнього документу</b> не може бути більшою за сьогоднішню.');
				}
			} else {
				//$Log->add('error', '<b>Дата отримання останнього документу</b> обов\'язкова для заповнення.');
			}
        }

		$PaymentsCalendar = new AccidentPaymentsCalendar($data);

		foreach ($data['payments_calendar'] as $payment) {

			$values = array();

			$values['accounts_id']	= $Authorization->data['id'];
			$values['accidents_id']	= $data['accidents_id'];
			$values['acts_id']		= $data['id'];

			$values = array_merge($values, $payment);

			$PaymentsCalendar->setConstants($values);
			$PaymentsCalendar->checkFields($values, 'insert');

			$amount = $amount + $payment['amount'];

		}
//_dump(round($data['amount'], 2));
//_dump(round($amount, 2));
		if ($data['insurance'] == 1 && $data['amount'] != $amount) {
			$Log->add('error', 'Сума збитків відрізняється від суми відшкодування.');
		}
	}

	function loadDocuments(&$data, $accidents_id, $id=null) {
		global $db;

		if (!intval($id)) {
			//!!!необходимо доработать на предмет проверки, а один ли акт
			$sql =	'SELECT id, documents ' .
					'FROM ' . PREFIX . '_accidents_acts ' .
					'WHERE accidents_id = ' . intval($accidents_id);
			$row = $db->getRow($sql);

			$id = $row['id'];
		} else {
			$sql =	'SELECT id, documents ' .
					'FROM ' . PREFIX . '_accidents_acts ' .
					'WHERE id = ' . intval($id);
			$row = $db->getRow($sql);
		}

		$conditions[] = 'acts_id = ' . intval($id);

		$sql =	'SELECT product_document_types_id ' .
				'FROM ' . PREFIX . '_accident_act_document_type_assignments ' .
				'WHERE ' . implode(' AND ', $conditions);
		$data['product_document_types']	= $db->getCol($sql);

		$data['document'] = explode($this->documentsDelimiter, $row['documents']);
	}

/*	//формируем номера страхового дела
    function setNumber($accidents_id, $id) {
        global $db;

        $sql =  'SELECT COUNT(*) ' .
                'FROM ' . PREFIX . '_accidents_acts ' .
                'WHERE accidents_id = ' . intval($accidents_id) . ' AND id <= ' . intval($id);
        $number = $db->getOne($sql);

        $sql =  'UPDATE ' . PREFIX . '_accidents_acts AS a, ' .
                PREFIX . '_accidents AS b SET ' .
                'a.number = CONCAT(b.number, \'-\', ' . $number. ') ' .
                'WHERE a.accidents_id = b.id AND a.id = ' . intval($id);
        $db->query($sql);
    }*/

/*
	//фиксируем суммы по выплаченным страховым актам
	function setAmount($accidents_id) {
		global $db;

		$sql =	'SELECT SUM(amount) ' .
				'FROM ' . PREFIX . '_accidents_property_acts ' .
				'WHERE accidents_id = ' . intval($accidents_id);
		$amount = $db->getOne($sql);

		$sql =	'UPDATE ' . PREFIX . '_accidents SET ' .
				'amount = ' . $db->quote($amount) . ' ' .
				'WHERE id = ' . intval($accidents_id);
		$db->query($sql);
	}
*/

	function setAdditionalFields($id, $data) {
		global $db;

		$PaymentsCalendar = new AccidentPaymentsCalendar($data);

		$PaymentsCalendar->mode = true;
        $PaymentsCalendar->permissions['insert'] = true;
		$PaymentsCalendar->permissions['update'] = true;

		$PaymentsCalendar->changeActPayments($id, $data);

		$this->updateDocumentTypes($id, $data);

		Accidents::generateDocuments($data['accidents_id'], 0, 0, $data['id'], array(DOCUMENT_TYPES_ACCIDENT_INSURANCE_PROPERTY_ACT));

		/*$Accidents = new Accidents($data);
		$Accidents->changeAccidentStatus($data['accidents_id'], $data['act_statuses_id']);*/
		
		$Accidents_PROPERTY = Accidents::factory($data, 'Property');
		
		if (in_array($Accidents_PROPERTY->getAccidentStatusesId($data['accidents_id']), array(ACCIDENT_STATUSES_COMPROMISE_AGREEMENT, ACCIDENT_STATUSES_INVESTIGATION, ACCIDENT_STATUSES_REINVESTIGATION, ACCIDENT_STATUSES_COMPROMISE_CONTINUE)) && $data['act_statuses_id'] != ACCIDENT_STATUSES_INVESTIGATION) {
			$Accidents = new Accidents($data);
			$Accidents->changeAccidentStatus($data['accidents_id'], $data['act_statuses_id']);
		}
		
		if (in_array($data['act_statuses_id'], array(ACCIDENT_STATUSES_INVESTIGATION, ACCIDENT_STATUSES_APPROVAL, ACCIDENT_STATUSES_COORDINATION)) && in_array($data['insurance'], array(2, 3))) {
			$sql = 'UPDATE ' . PREFIX . '_accidents_acts as accidents_acts, ' . PREFIX . '_accidents as accidents ' .
				   'SET accidents_acts.reason = accidents.reason, accidents_acts.reason_not_payment = accidents.reason_not_payment ' .
				   'WHERE accidents_acts.accidents_id = accidents.id AND accidents.id = ' . intval($data['accidents_id']) . ' AND accidents_acts.id = ' . intval($id);
			$db->query($sql);
		}
    }

    function insert($data, $redirect=true) {
        global $Log;

		parent::insert($data, false, true, true);

        if (!$Log->isPresent()) {

			$this->setFields();

		    $data['id'] = parent::insert($data, false);

			if ($data['id']) {

				$this->setNumber($data['accidents_id'], $data['id'], $data['insurance']);

				$this->setAdditionalFields($data['id'], $data);

				$params['title']    = $this->messages['single'];
				$params['id']       = $data['id'];
				$params['storage']  = $this->tables[0];

                //отправляем письмо на отдел учета и регистрации о создании акта
                /*$Accidents = new Accidents($data);
                $Accidents->send($data['accidents_id'],'Accident. createdAct');*/

				if ($redirect) {

					$Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

					header('Location: /?do=Accidents|' . $this->mode . 'Acts&accidents_id=' . $data['accidents_id'] . '&product_types_id=' . $data['product_types_id']);
					exit;
				} else {
					return $params['id'];
				}
			}
		} else {
			$this->showForm($data, 'insert', 'insert');
		}
    }

    function prepareFields($action, &$data) {
		global $db;

        $data = parent::prepareFields($action, $data);

		$sql =	'SELECT b.*, a.*, d.*,  c.insurance, c.id as accidents_id, ' .
                'a.insurance as act_insurance, ' .
				'date_format(datetime_average, ' . $db->quote(DATETIME_FORMAT) . ') AS datetime_average_format, date_format(datetime_average, \'%Y\') AS datetime_average_year, date_format(datetime_average, \'%m\') AS datetime_average_month, date_format(datetime_average, \'%d\') AS datetime_average_day, date_format(datetime_average, \'%k\') AS datetime_average_hour, date_format(datetime_average, \'%i\') AS datetime_average_minute, ' .
				'date_format(mvs_date_average, ' . $db->quote(DATETIME_FORMAT) . ') AS mvs_date_average_format, date_format(mvs_date_average, \'%Y\') AS mvs_date_average_year, date_format(mvs_date_average, \'%m\') AS mvs_date_average_month, date_format(mvs_date_average, \'%d\') AS mvs_date_average_day, ' .
				'description_average, criminal, regres ' .
				'FROM ' . PREFIX . '_accidents_acts AS a ' .
                'JOIN ' . PREFIX . '_accidents_property_acts as d ON a.id = d.accidents_acts_id ' .
				'JOIN ' . PREFIX . '_accidents_property AS b ON a.accidents_id = b.accidents_id ' .
				'JOIN ' . PREFIX . '_accidents AS c ON a.accidents_id = c.id ' .
				'WHERE a.id = ' . intval($data['id']);
		$row = $db->getRow($sql);

		$data = array_merge($row, $this->getPolicyValues($data['accidents_id']), $data);

		$act_statuses = array(
			ACCIDENT_STATUSES_INVESTIGATION,
			ACCIDENT_STATUSES_COORDINATION,
			ACCIDENT_STATUSES_APPROVAL,
			ACCIDENT_STATUSES_PAYMENT,
			ACCIDENT_STATUSES_SUSPENDED,
			ACCIDENT_STATUSES_RESOLVED/*,
			ACCIDENT_STATUSES_TRANSFER_INSURANCE_COMPANY*/);

		$data['act_statuses_id'] = (!in_array($data['act_statuses_id'], $act_statuses)) ? ACCIDENT_STATUSES_INVESTIGATION : $data['act_statuses_id'];

		$sql =	'SELECT a.*, SUM(b.amount) AS payed_amount ' .
				'FROM ' . PREFIX . '_accident_payments_calendar AS a ' .
				'LEFT JOIN ' . PREFIX . '_accident_payments AS b ON a.id = b.payments_calendar_id ' .
				'WHERE a.acts_id = ' . intval($data['id']) . ' ' .
				'GROUP BY a.id';

		$data['payments_calendar'] = $db->getAll($sql);
		
		if ($action == 'updateApproval' && $data['date'] == '0000-00-00') {
			$data['date'] = BankDay::getEndDate($data['documents_date'], $data['approval_term'], 'd.m.Y');			
			$data['date_day'] = substr($data['date'], 0, 2);
			$data['date_month'] = substr($data['date'], 3, 2);
			$data['date_year'] = substr($data['date'], 6, 4);
		}

        return $data;
    }

    function getAssignmentConditions($action, $prefixSQL='', $postfixSQL='') {
		if ($action == 'view') {
			$conditions[] = PREFIX . '_accidents_acts.accidents_id = ' . PREFIX . '_accidents.id';

            return $prefixSQL . implode(' AND ', $conditions) . $postfixSQL;
		} else {
			return parent::getAssignmentConditions($action, $prefixSQL, $postfixSQL);
		}
    }

    function view($data, $conditions=null, $sql=null, $template=null, $showForm=true) {
        global $db;
        $this->checkPermissions('view', $data);
  
		if (is_array($data['id'])) $data['id'] = $data['id'][0];

		$this->setTables('view');
		$this->getFormFields('view');

		$identityField = $this->getIdentityField();

		$prefix = ($conditions) ? implode(' AND ', $conditions) : '';

		$sql =	'SELECT ' . implode(', ', $this->formFields) . ' ' .
				'FROM ' . PREFIX . '_accidents_acts, ' .
                PREFIX . '_accidents_property_acts, ' .
				PREFIX . '_accidents_property, ' .
                PREFIX . '_accidents ' .
				'WHERE ' . PREFIX . '_accidents_property_acts.accidents_acts_id = ' . PREFIX . '_accidents_acts.id AND ' . $this->getAssignmentConditions('view', $prefix, ' AND ') . PREFIX . '_' . $identityField['table'] . '.' . $identityField['name'] . '=' . intval($data['id']);

		return parent::view($data, $conditions, $sql, $template, $showForm);
    }

    function update($data, $redirect=true) {
        global $Log;

		parent::update(&$data, false, false, true);

		if (!$Log->isPresent()) {

			$this->setFields();

			$data['id'] = parent::update($data, false);

			if ($data['id']) {

				$this->setAdditionalFields($data['id'], $data);
				$this->setTheoryLimitPaymentDate($data['id'], 2);
				
				$params['title']    = $this->messages['single'];
				$params['id']       = $data['id'];
				$params['storage']  = $this->tables[0];

				if ($redirect) {

					$Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

					header('Location: /?do=Accidents|' . $this->mode . 'Acts&accidents_id=' . $data['accidents_id'] . '&product_types_id=' . $data['product_types_id']);
					exit;
				} else {
					return $params['id'];
				}
			}
		} else {
			$this->showForm($data, 'update', 'update');
		}
    }

	/*function getEssentialActInWindow($data) {
		global $db;

		$conditions[] = 'accidents_id = ' . intval($data['accidents_id']);
		$conditions[] = 'id <> ' . intval($data['id']);

		$sql =	'SELECT * ' .
				'FROM ' . PREFIX . '_accidents_property_acts ' .
				'WHERE ' . implode(' AND ', $conditions) . ' ' .
				'ORDER BY id DESC ' .
				'LIMIT 1';
		$row =	$db->getRow($sql);

		echo '{"recipient":"' . addslashes(html_entity_decode($row['recipient'])) . '","identification_code":"' . $row['recipient_identification_code'] . '","bank":"' . addslashes(html_entity_decode($row['bank'])) . '","bank_mfo":"' . $row['bank_mfo'] . '","bank_account":"' . $row['recipient_bank_account'] . '"}';
		exit;
	}*/

	function getXML($data) {
		global $db, $Smarty;

		if ($data['number']) {

            $conditions[] = 'a.number = ' . $db->quote($data['number']);
			$conditions[] = 'a.act_statuses_id = ' . ACCIDENT_STATUSES_PAYMENT;

			$sql =	'SELECT a.*, a.id AS acts_id, b.number as accidents_number,c.number as policies_number ' .
					'FROM ' . PREFIX . '_accidents_property_acts AS a ' .
					'JOIN ' . PREFIX . '_accidents AS b ON a.accidents_id = b.id ' .
					'JOIN ' . PREFIX . '_policies AS c ON b.policies_id = c.id ' .
					'WHERE ' . implode(' AND ', $conditions);
		    $list = $db->getAll($sql);

			if (is_array($list)) {
				foreach($list as $i => $row) {

					$sql =	'SELECT * ' .
							'FROM ' . PREFIX . '_accident_payments_calendar ' .
							'WHERE accidents_id = ' . intval($row['accidents_id']) . ' AND acts_id = ' . intval($row['acts_id']);
					$payments = $db->getAll($sql);

					if (is_array($payments)) {
						foreach($payments as $j=>$payment) {
							$list[ $i ]['act_recipient' . $j] = $payment['recipient'];
							$list[ $i ]['act_recipient_identification_code' . $j] = $payment['recipient_identification_code'];
							$list[ $i ]['act_recipient_types_id' . $j] = $payment['recipient_types_id'];
							$list[ $i ]['act_amount' . $j] = $payment['amount'];
						}
					}
				}
			}
        } else {
			$list= array();
		}

        $Smarty->assign('list', $list);

        return $Smarty->fetch($this->object . '/act.xml');
	}
	
	function setTheoryLimitPaymentDate($id, $type) {
		global $db;
		
		switch ($type){
			case 1:
				$date = $db->getOne('SELECT date FROM ' . PREFIX . '_accidents_acts WHERE id = ' . intval($id));
				$total_term = $db->getOne('SELECT payment_term FROM ' . PREFIX . '_accidents_acts WHERE id = ' . intval($id));
				break;
			case 2:
				$date = $db->getOne('SELECT documents_date FROM ' . PREFIX . '_accidents_acts WHERE id = ' . intval($id));
				$total_term = $db->getOne('SELECT approval_term + payment_term FROM ' . PREFIX . '_accidents_acts WHERE id = ' . intval($id));
				break;
		}
		
		$sql = 'UPDATE ' . PREFIX . '_accident_payments_calendar ' .
			   'SET theory_limit_payment_date = ' . $db->quote(BankDay::getEndDate($date, $total_term, 'Y-m-d')) . ' ' .
			   'WHERE acts_id = ' . intval($id);
		$db->query($sql);
	}
	
	function getLimitsDateInWindow($data) {
		if ($data['documents_date'] != '0000-00-00' && $data['documents_date'] != '' && $data['documents_date'] != '..') {
			$limit_approval_date = BankDay::getEndDate($data['documents_date'], $data['approval_term'], 'd.m.Y');
		} else {
			$limit_approval_date = '';
		}
		
		if ($data['date'] == '0000-00-00' || $data['date'] == '') {
			$limit_payment_date = BankDay::getEndDate($data['documents_date'], $data['approval_term'] + $data['payment_term'], 'd.m.Y');
		} elseif ($data['date'] != '0000-00-00' && $data['date'] != '') {
			$limit_payment_date = BankDay::getEndDate($data['date'], $data['payment_term'], 'd.m.Y');
		} else {
			$limit_payment_date = '';
		}
		
		echo '{"limit_approval_date" : "' . $limit_approval_date . '", "limit_payment_date" : "' . $limit_payment_date . '"}';
	}
}

?>