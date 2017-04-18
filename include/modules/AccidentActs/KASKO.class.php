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

class AccidentActs_KASKO extends AccidentActs {

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
					array(
						'name'                	=> 'insurance_price',
						'description'        	=> 'Страхова сума, грн.',
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
						'table'                	=> 'accidents_acts'),
					array(
						'name'                	=> 'market_price',
						'description'        	=> 'Ринкова вартість, грн.',
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
						'table'                	=> 'accidents_kasko_acts'),
					array(
						'name'                	=> 'proportionality_value',
						'description'        	=> 'Коефіцієнт пропорційності',
						'type'                	=> fldPercent,
						'maxlength'				=> 7,
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
						'table'                	=> 'accidents_kasko_acts'),
					array(
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
						'table'                	=> 'accidents_kasko_acts'),
					array(
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
						'table'                	=> 'accidents_kasko_acts'),
					array(
						'name'                	=> 'extent_damage_percent',
						'description'        	=> 'Тотальний збиток, %',
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
						'table'                	=> 'accidents_kasko_acts'),
/*
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
						'table'					=> 'accidents_kasko_acts'),
*/
					array(
						'name'                	=> 'amount_residual',
						'description'        	=> 'Вартість залишків, грн.',
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
						'table'                	=> 'accidents_kasko_acts'),
					array(
						'name'                	=> 'payment_document_number',
						'description'        	=> 'Згідно, номер',
						'type'                	=> fldText,
						'maxlength'				=> 300,
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
						'table'                	=> 'accidents_acts'),*/
					array(
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
						'table'                	=> 'accidents_kasko_acts'),
					array(
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
						'table'                	=> 'accidents_kasko_acts'),
					array(
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
						'table'                	=> 'accidents_kasko_acts'),
					array(
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
						'table'                	=> 'accidents_kasko_acts'),
                    array(
                        'name'                	=> 'not_proportionality',
                        'description'        	=> 'Не враховувати у пропорцію',
                        'type'                	=> fldBoolean,
                        'display'            	=>
                        array(
                            'show'        	=> true,
                            'insert'    	=> false,
                            'change'        => true,
                            'view'        	=> false,
                            'update'    	=> true
                        ),
                        'verification'        	=>
                        array(
                            'canBeEmpty'    => true
                        ),
                        'orderPosition'			=> 4,
                        'width'				    => 100,
                        'table'                	=> 'accidents_kasko_acts'),
					array(
                        'name'                	=> 'in_repair',
                        'description'        	=> 'В ремонті',
                        'type'                	=> fldBoolean,
                        'display'            	=>
                        array(
                            'show'        	=> true,
                            'insert'    	=> false,
                            'change'        => true,
                            'view'        	=> false,
                            'update'    	=> true
                        ),
                        'verification'        	=>
							array(
								'canBeEmpty'    => true
							),
                        'orderPosition'			=> 5,
                        'width'				    => 100,
                        'table'                	=> 'accidents_acts'),
					array(
						'name'                	=> 'amount_compensation',
						'description'        	=> 'Вартість транспортування, грн.',
						'type'                	=> fldMoney,
						'display'            	=>
							array(
								'show'        	=> false,
								'insert'    	=> true,
								'view'        	=> true,
								'update'    	=> true,
                                'change'        => true
							),
						'verification'        	=>
							array(
								'canBeEmpty'    => false
							),
						'table'                	=> 'accidents_kasko_acts'),
					array(
						'name'                	=> 'amount_evacuate',
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
						'table'                	=> 'accidents_kasko_acts'),
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
					/*array(
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
                    array(
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
                        'table'                	=> 'accidents_acts')
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
								'view'        	=> false,
								'update'    	=> true
							),
						'verification'        	=>
							array(
								'canBeEmpty'    => false
							),
						'table'                	=> 'accidents_acts'),
					array(
						'name'                	=> 'insurance_price',
						'description'        	=> 'Страхова сума, грн.',
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
						'table'                	=> 'accidents_acts'),
					array(
						'name'                	=> 'market_price',
						'description'        	=> 'Ринкова вартість, грн.',
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
						'table'                	=> 'accidents_kasko_acts'),
					array(
						'name'                	=> 'proportionality_value',
						'description'        	=> 'Коефіцієнт пропорційності',
						'type'                	=> fldPercent,
						'maxlength'				=> 7,
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
						'table'                	=> 'accidents_kasko_acts'),
					array(
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
						'table'                	=> 'accidents_kasko_acts'),
                    array(
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
						'table'                	=> 'accidents_kasko_acts'),
					array(
						'name'                	=> 'extent_damage_percent',
						'description'        	=> 'Тотальний збиток, %',
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
						'table'                	=> 'accidents_kasko_acts'),
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
						'table'					=> 'accidents_kasko_acts'),
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
						'table'					=> 'accidents_kasko_acts'),
					array(
						'name'                	=> 'amount_residual',
						'description'        	=> 'Вартість залишків, грн.',
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
						'table'                	=> 'accidents_kasko_acts'),
					array(
						'name'                	=> 'payment_document_number',
						'description'        	=> 'Згідно, номер',
						'type'                	=> fldText,
						'maxlength'				=> 300,
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
						'table'                	=> 'accidents_acts'),*/
					array(
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
						'table'                	=> 'accidents_kasko_acts'),
					array(
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
						'table'                	=> 'accidents_kasko_acts'),
					array(
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
						'table'                	=> 'accidents_kasko_acts'),
					array(
						'name'                	=> 'discount_percent',
						'description'        	=> 'Знижка, %',
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
								'canBeEmpty'    => true
							),
						'table'                	=> 'accidents_kasko_acts'),
                    array(
						'name'                	=> 'discount_amount',
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
								'canBeEmpty'    => true
							),
						'table'                	=> 'accidents_kasko_acts'),
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
						'table'                	=> 'accidents_kasko_acts'),
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
						'table'                	=> 'accidents_kasko_acts'),
                    array(
                        'name'                	=> 'not_proportionality',
                        'description'        	=> 'Не враховувати у пропорцію',
                        'type'                	=> fldBoolean,
                        'display'            	=>
							array(
								'show'        	=> true,
								'insert'    	=> false,
								'change'        => true,
								'view'        	=> false,
								'update'    	=> true
							),
                        'verification'        	=>
							array(
								'canBeEmpty'    => true
							),
                        'orderPosition'			=> 4,
                        'width'				    => 100,
                        'table'                	=> 'accidents_kasko_acts'),
					array(
                        'name'                	=> 'in_repair',
                        'description'        	=> 'В ремонті',
                        'type'                	=> fldBoolean,
                        'display'            	=>
							array(
								'show'        	=> true,
								'insert'    	=> false,
								'change'        => true,
								'view'        	=> false,
								'update'    	=> true
							),
                        'verification'        	=>
							array(
								'canBeEmpty'    => true
							),
                        'orderPosition'			=> 5,
                        'width'				    => 100,
                        'table'                	=> 'accidents_acts'),
					array(
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
						'table'                	=> 'accidents_kasko_acts'),
					array(
						'name'                	=> 'amount_compensation',
						'description'        	=> 'Евакуатор, грн.',
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
						'orderPosition'			=> 5,
						'table'                	=> 'accidents_kasko_acts'),
                    array(
                        'name'                  =>  'calc_info',
                        'description'           =>  'Розрахунок',
                        'type'                  =>  fldHidden,
                        'display'               =>
                            array(
                                'show'          =>  false,
                                'insert'        =>  true,
                                'view'          =>  false,
                                'update'        =>  true
                            ),
                        'verification'          =>
                            array(
                                'canBeEmpty'    =>  true
                            ),
                        'table'                 =>  'accidents_kasko_acts'),
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
						'orderPosition'         => 7,
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
								'insert'    	=> false,
								'view'       	=> false,
								'update'    	=> false
							),
						'verification'        	=>
							array(
								'canBeEmpty'    => false
							),
						'orderPosition'			=> 9,
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
                    array(
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
                        'table'                	=> 'accidents_acts'),
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
						'table'                	=> 'accidents_acts'),
					array(
						'name'                	=> 'accidents_acts_transfer_id',
						'description'        	=> 'Номер реєстру передачі СА',
						'type'                	=> fldText,
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
						'orderPosition'			=> -1,
						'table'                	=> 'accidents_acts')
				),
			'common'    =>
				array(
					'defaultOrderPosition'    	=> 10,
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
						'name'                  => 'date',
						'description'           => 'Дата',
						'type'                  => fldDate,
                        //'value'                 => 'NOW()',
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
						'name'                  => 'sign_suspended',
						'description'           => 'Ознака призупинення',
						'type'                  => fldBoolean,
						'display'               =>
							array(
								'show'          => true,
								'insert'        => false,
								'view'          => false,
								'update'        => false
							),
						'verification'          =>
							array(
								'canBeEmpty'    => true
							),
						'table'             	=> 'accidents_acts'),
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

    function AccidentActs_KASKO($data) {
        AccidentActs::AccidentActs($data);

		$this->messages['plural'] = 'Страхові акти';
		$this->messages['single'] = 'Страховий акт';

		$this->product_types_id = PRODUCT_TYPES_KASKO;
    }

	function setFields() {	
		foreach ($this->formDescription['fields'] as $i => $field) {
			if ( $field['table'] != 'accidents_acts' && $field['table'] != 'accidents_kasko_acts' && $field['table'] != 'accidents_acts_transfer') {
				unset($this->formDescription['fields'][ $i ]);
			}
		}		
	}

    function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {
		global $Authorization;

		$this->setFields();

		return parent::show($data, $fields, $conditions, $sql, $template, $limit);
	}

	function getPolicyValues($id) {
		global $db;

		$sql =	'SELECT a.policies_id, a.risks_id, a.estimate_managers_id, a.average_managers_id, a.insurance, a.accident_statuses_id, a.comment, a.reason, date_format(a.datetime, ' . $db->quote(DATETIME_FORMAT) . ') as datetime_datetime_format, ' .
				'b.accidents_id,b.items_id, b.address, b.mvs, b.mvs_id, b.options_deterioration_no, b.options_deductible_glass_no, b.options_first_accident, b.options_season, b.options_holiday, b.options_work, b.options_taxy, b.options_agregate_no, b.options_years, ' .
				'c.number AS policies_number, m.number as drive_general_policies_number, date_format(m.date, ' . $db->quote(DATE_FORMAT) . ') as drive_general_policies_date_format,  date_format(n.date, ' . $db->quote(DATE_FORMAT) . ') AS policies_date_format, date_format(c.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') AS policies_begin_datetime_format, date_format(c.interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') AS policies_interrupt_datetime_format, IF(h.items_id IS NULL, e.car_price + e.price_equipment, h.item_price) AS policies_price, c.amount AS policies_amount, c.product_types_id as policies_product_types_id, ' .
				'd.insurer_identification_code as policies_insurer_identification_code, d.insurer_edrpou as policies_insurer_edrpou, d.insurer_person_types_id AS policies_insurer_person_types_id, d.insurer_lastname AS policies_insurer_lastname, d.insurer_firstname AS policies_insurer_firstname, d.insurer_patronymicname AS policies_insurer_patronymicname, d.insurer_company AS policies_insurer_company, ' .
				'd.options_deterioration_no AS policies_options_deterioration_no, d.options_deductible_glass_no AS policies_options_deductible_glass_no, d.options_first_accident AS policies_options_first_accident, d.options_season AS policies_options_season, d.options_holiday AS policies_options_holiday, d.options_work AS policies_options_work, d.options_taxy AS policies_options_taxy, d.options_agregate_no AS policies_options_agregate_no, d.options_years AS policies_options_years, ' .
				'e.car_price as car_price, e.price_equipment AS equipment_price, e.deductibles_value0 AS policies_deductibles_value0, e.deductibles_absolute0 AS policies_deductibles_absolute0, e.deductibles_value1 AS policies_deductibles_value1, e.deductibles_absolute1 AS policies_deductibles_absolute1, ' .
				'SUM(f.amount) AS policy_payments_amount ' .
				'FROM ' . PREFIX . '_accidents AS a ' .
				'JOIN ' . PREFIX . '_accidents_kasko AS b ON a.id = b.accidents_id ' .
				'JOIN ' . PREFIX . '_policies AS c ON a.policies_id = c.id ' .
				'JOIN ' . PREFIX . '_policies_kasko AS d ON a.policies_id = d.policies_id ' .
				'JOIN ' . PREFIX . '_policies_kasko_items AS e ON a.policies_id = e.policies_id AND b.items_id = e.id ' .
				'LEFT JOIN ' . PREFIX . '_policy_payments AS f ON a.policies_id = f.policies_id ' .
                'JOIN ' . PREFIX . '_accidents_kasko AS g ON a.id = g.accidents_id ' .
                'LEFT JOIN ' . PREFIX . '_policies_kasko_item_years_payments AS h ON g.items_id = h.items_id AND a.datetime BETWEEN h.date AND ADDDATE(h.date, INTERVAL 1 YEAR) ' .
                'LEFT JOIN ' . PREFIX . '_policies_drive as k ON a.policies_id = k.policies_id ' .
                'LEFT JOIN ' . PREFIX . '_policies as l ON k.policies_general_id = l.id ' .
                'LEFT JOIN ' . PREFIX . '_policies as m ON l.top = m.id ' .
                'LEFT JOIN (SELECT number, MIN(date) as date FROM ' . PREFIX . '_policies GROUP BY number) as n ON c.number = n.number ' .
				'WHERE a.id = ' . intval($id) . ' ' .
				'GROUP BY f.policies_id';
		$row =	$db->getRow($sql);

        $row['policies_insurer_company'] = str_replace('&quot;', '\"', $row['policies_insurer_company']);
		$Accidents = Accidents::factory($data, 'KASKO');


		$row['insurance_price'] = ($row['policies_options_agregate_no'] == 1) ? $row['policies_price'] : $row['policies_price'] - $Accidents->getAmountPrevious($row['accidents_id'], 1);
		$row['amount_previous_accidents'] = $Accidents->getAmountPrevious($row['accidents_id'], 1);
        $row['amount_previous_acts'] = $this->getAmountPrevious($row['accidents_id'], $row['id']);
		if ($id == '1986') {
			$row['insurance_price'] = $row['policies_price'];
		}
 
		return $row;
	}

    //суммы по предыдущим страховым актам
    function getAmountPrevious($accidents_id, $id) {
        global $db;

        $conditions[] = 'accidents_id = ' . intval($accidents_id);
        $conditions[] = 'act_type IN (' . ACCIDENT_INSURANCE_ACT_TYPE_FIRST_AMOUNT . ', ' . ACCIDENT_INSURANCE_ACT_TYPE_EXTRA_CHARGE . ')';

        if (intval($id)) {
            $conditions[] = 'id < ' . intval($id);

        }

        $sql =	'SELECT SUM(IF(b.not_proportionality IS NULL,0, a.amount)) as summ ' .
                'FROM ' . PREFIX . '_accidents_acts as a ' .
                'LEFT JOIN ' . PREFIX . '_accidents_kasko_acts as b ON a.id = b.accidents_acts_id AND b.not_proportionality = 0 ' .
                'WHERE ' . implode(' AND ', $conditions);

        $amount = $db->getOne($sql);

        return ($amount > 0) ? $amount : 0;
    }

	function getPrevious($accidents_id) {
		global $db;

		$fields = array(
			'b.market_price',
			'b.proportionality_value',
			'b.deterioration_value',
			'b.deterioration_basis',
			'b.extent_damage_percent',
			'b.deductibles_amount',
			'b.deductibles_change',
			'b.amount_residual',
			'b.discount_percent',
            'b.discount_amount',
			'b.discount_basis');

		$sql =	'SELECT ' . implode(', ', $fields) . ' ' .
				'FROM ' . PREFIX . '_accidents_acts as a ' .
                'JOIN ' . PREFIX . '_accidents_kasko_acts as b ON a.id = b.accidents_acts_id ' .
				'WHERE a.accidents_id = ' . intval($accidents_id) . ' ' .
				'ORDER BY a.id DESC ' .
				'LIMIT 1';
		return	$db->getRow($sql);
	}

    function showForm($data, $action, $actionType=null, $template=null) {
		global $Authorization;
		if (is_null($template)) {
			$template = 'kaskoInvestigation.php';
		}
//_dump($data);exit;
		$data['accidents'] = Accidents::factory($data, 'KASKO');

		$data['accident_statuses_id'] = $data['act_statuses_id'];
		$this->formDescription['fields'][ $this->getFieldPositionByName('act_statuses_id') ]['verification']['canBeEmpty'] = false;
		$this->formDescription['fields'][ $this->getFieldPositionByName('act_statuses_id') ]['list'] = $data['accidents']->getListValue($data['accidents']->formDescription['fields'][ $data['accidents']->getFieldPositionByName('accident_statuses_id') ], $data);

		$data['risks'] = $data['accidents']->getRisks($data['accidents_id']);

        if($data['message_types_id'] && !$data['message']) {// убираем id из data если акт создается из задачи по Расчету. Так как в функцию подсчета суммы предыдущих актов лезет id задачи.
		   unset($data['id']);
        }

        $data['amount_previous_acts'] = $this->getAmountPrevious($data['accidents_id'], $data['id']);
        $data['acts_count'] = $this->getCount($data['accidents_id']);

		if ($data['amount_previous_acts'] > 0) {
			$data = array_merge($data, $this->getPrevious($data['accidents_id']));
		}
        $data['important_person'] = Accidents::getImportantPerson($data['policies_id']);

        return parent::showForm($data, $action, $actionType, $template);
    }

	function getMVSDocument($accidents_id) {
		global $db;

		$sql =	'SELECT mvs_average, mvs_title_average ' .
				'FROM ' . PREFIX . '_accidents_kasko ' .
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
               'WHERE accidents_id = ' . $data['accidents_id'] . ' AND act_statuses_id IN ( ' . ACCIDENT_STATUSES_INVESTIGATION.', ' . ACCIDENT_STATUSES_APPROVAL.', ' . ACCIDENT_STATUSES_COORDINATION . ')';
        if(intval($db->getOne($sql)) > 0 && $Authorization->data['roles_id'] != ROLES_ADMINISTRATOR || !in_array(Accidents::getAccidentStatusesId($data['accidents_id']), array(ACCIDENT_STATUSES_INVESTIGATION, ACCIDENT_STATUSES_REINVESTIGATION, ACCIDENT_STATUSES_COMPROMISE_CONTINUE))) {
           $this->permissions['insert'] = false;
        }
		//_dump(Accidents::getRisksId($data['accidents_id']) != RISKS_HIJACKING1);exit;
		$sql = 'SELECT compromise, compromise_date ' .
			   'FROM ' . PREFIX . '_accidents ' .
			   'WHERE id = ' . intval($data['accidents_id']);
		$compromise_info = $db->getRow($sql);
		if ($compromise_info['compromise'] == 1 && ($compromise_info['compromise_date'] == NULL || $compromise_info['compromise_date'] == '0000-00-00')) {
			$this->permissions['insert'] = false;
			$Log->add('error', 'Для компромісних справ перед створенням акту потрібно проставити дату рішення');
		}
		if ($data['message'] == 1 && $data['insurance'] == 1 && !intval(Accidents::getRepairClassificationsId($data['accidents_id'])) && ($data['amount_details']+$data['amount_work']+$data['amount_material']) < $data['market_price'] * $data['extent_damage_percent'] / 100) {
			$this->permissions['insert'] = false;
			$Log->add('error', 'Перед створенням акту потрібно проставити <b>\'Клас відновлювального ремонту\'</b>');
		} elseif (!intval($data['message']) && $data['insurance'] == 1 && !intval(Accidents::getRepairClassificationsId($data['accidents_id'])) && Accidents::getRisksId($data['accidents_id']) != RISKS_HIJACKING1) {
			$this->permissions['insert'] = false;
			$Log->add('error', 'Перед створенням акту потрібно проставити <b>\'Клас відновлювального ремонту\'</b>');
		}

		$data = array_merge($data, $this->getPolicyValues($data['accidents_id']));

        $data['important_person'] = Accidents::getImportantPerson($data['policies_id']);
		$data['amount_expertize']		= AccidentPaymentsCalendar::getAmount($data['accidents_id'], PAYMENT_TYPES_EXPERTISE);
		$data['amount_evacuate']		= AccidentPaymentsCalendar::getAmount($data['accidents_id'], PAYMENT_TYPES_EVACUATOR);
        
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
            $payment_documents_number = explode(', ', $data['payment_document_number']);
            foreach($payment_documents_number as $payment_document_number)
                $data['document'][] = $payment_document_number;
			//$data['document'][] = $data['payment_document_number'];// . ' від ' . $data['payment_document_date_day'] . '.' . $data['payment_document_date_month'] . '.' . $data['payment_document_date_year'];
        }

        $data['policy_payments_calendar'] = Accidents::getPolicyPaymentsCalendar($data['policies_number'], $data['policies_id'], $data['policies_product_types_id']);
        $data['accidents_date_values'] = Accidents::getAccidentsDateValues($data['accidents_id']);

        $data['extent_damage_percent'] = 70;

		return parent::add($data);
	}

     function load($data, $showForm=true, $action='update', $actionType='update', $template=null) {
        global $db, $Authorization;

        $this->checkPermissions('update', $data);

        if (is_array($data['id'])) $data['id'] = $data['id'][0];

        if ($data['message']) {
            $message_values = $data;
        }

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

        if (sizeof($message_values)) $data = array_merge($data, $message_values);

        $data['policy_payments_calendar'] = Accidents::getPolicyPaymentsCalendar($data['policies_number'], $data['policies_id'], $data['policies_product_types_id']);
        $data['accidents_date_values'] = Accidents::getAccidentsDateValues($data['accidents_id']);
        
        if ($showForm) {
            $this->showForm($data, $action, $actionType, $template);
        } else {
            return $data;
        }
      
    }

	function setConstants(&$data) {

        if ($data['discount_type'] == 1) {
            $this->formDescription['fields'][ $this->getFieldPositionByName('discount_amount') ]['display']['update'] = false;
        } elseif ($data['discount_type'] == 2) {
            $this->formDescription['fields'][ $this->getFieldPositionByName('discount_percent') ]['display']['update'] = false;
        }
		
		if ($data['do'] == 'AccidentActs|updateApproval') {
			$this->formDescription['fields'][ $this->getFieldPositionByName('approval_term') ]['display']['update'] = false;
			$this->formDescription['fields'][ $this->getFieldPositionByName('payment_term') ]['display']['update'] = false;
		}

		if ($data['insurance'] != 1) {
			unset($this->formDescription['fields'][ $this->getFieldPositionByName('payment_term') ]);
		}
		
		if ($data['updateRisk'] == 1) {
			$this->formDescription['fields'][ $this->getFieldPositionByName('documents_date') ]['display']['update'] = false;
			$this->formDescription['fields'][ $this->getFieldPositionByName('approval_term') ]['display']['update'] = false;
			$this->formDescription['fields'][ $this->getFieldPositionByName('payment_term') ]['display']['update'] = false;
		}

		parent::setConstants($data);

		if (intval($data['insurance']) == 1) {
			//начало расчета суммы возмещения

			//вычисляем коэффициент пропорциональности
			$data['proportionality_value'] = ($data['insurance_price'] / $data['market_price'] > 1 || $data['policies_product_types_id'] == 11) ? 1 : round($data['insurance_price'] / $data['market_price'], 5);
//$data['proportionality_value'] = 1;
			//определяем страховую сумму
			$data['price'] = ($data['insurance_price'] < $data['market_price']) ? $data['insurance_price'] : $data['market_price'];
//$data['price'] = $data['market_price'];

			$Accidents = Accidents::factory($data, 'KASKO');

			$data['amount_previous_accidents'] = $Accidents->getAmountPrevious($data['accidents_id'], 1);

			$data['amount_previous_acts'] = $this->getAmountPrevious($data['accidents_id'], $data['id']);

			//вычисляем сумму страхового возмещения без учета франшизы
			$data['amount'] = ($data['amount_details'] * (1 - $data['deterioration_value']) + $data['amount_material'] + $data['amount_work']) * $data['proportionality_value'];

			if ($data['risks_id'] == RISKS_HIJACKING1) {
				$data['amount'] = $data['amount'] - $data['amount_previous_acts'];
			}
                          
            // учитываем франшизу
			if (!intval($data['deductibles_change'])) {
				$data['deductibles_amount'] = 0;

				$deductible = '0';
		
				if ($data['extent_damage_percent'] <= $data['amount'] / $data['market_price'] * 100 && $data['policies_product_types_id'] != 11 || $data['extent_damage_percent'] <= $data['amount'] / $data['insurance_price'] * 100 && $data['policies_product_types_id'] == 11) {//тотал
					//$data['amount'] = $data['policies_price'];
					$total = 1;
					if ($data['policies_product_types_id'] != 11) {
						$data['price'] = ($data['market_price'] - $data['amount_residual']) * $data['proportionality_value'];
					}
					$data['amount'] = $data['price'] - $data['amount_previous_acts'];
					$deductible = '1';

				} else {//не тотал
					$data['amount_residual'] = 0;
						
					$data['amount'] = $data['amount'] - $data['amount_previous_acts'];
					
					//$data['amount'] = $data['amount'] - $data['amount_previous_accidents'];////////////////////////////////////////

					$deductible = ($data['risks_id'] == RISKS_HIJACKING1) ? '1' : '0';
				}
		
				$data['deductibles_amount'] = ($data['policies_deductibles_absolute' . $deductible] == '0')
					/*? floor($data['policies_price'] * $data['policies_deductibles_value' . $deductible]) / 100
					: round($data['policies_deductibles_value' . $deductible],2);*/
                    			? $this->roundNumber($data['policies_price'] * $data['policies_deductibles_value' . $deductible] / 100,2)
					: $this->roundNumber($data['policies_deductibles_value' . $deductible],2);
				//0 франшиза на стекла
				if ($data['options_deductible_glass_no'] == '1') {
                    $data['deductibles_value']  = 0;
					$data['deductibles_amount'] = 0;
				}
			}
            else{
                //if ($data['extent_damage_percent'] <= $data['amount'] / $data['market_price'] * 100) {//тотал
				if ($data['extent_damage_percent'] <= $data['amount'] / $data['market_price'] * 100 && $data['policies_product_types_id'] != 11 || $data['extent_damage_percent'] <= $data['amount'] / $data['insurance_price'] * 100 && $data['policies_product_types_id'] == 11) {//тотал
					$total = 1;
					if ($data['policies_product_types_id'] != 11) {
						$data['price'] = ($data['market_price'] - $data['amount_residual']) * $data['proportionality_value'];
					}
					$data['amount'] = $data['price'] - $data['amount_previous_acts'];
                }
                else {//не тотал
					$data['amount'] = $data['amount'] - $data['amount_previous_acts'];
					$data['amount_residual'] = 0;

					$deductible = ($data['risks_id'] == RISKS_HIJACKING1) ? '1' : '0';
				}
            }

            if ($data['discount_type'] == 1 && $total == 0) {
			    $data['amount'] = ($data['amount'] - $data['deductibles_amount'] - $data['amount_residual']) * (100 - $data['discount_percent']) / 100;
            } elseif ($data['discount_type'] == 2 && $total == 0) {
                $data['amount'] = $data['amount'] - $data['deductibles_amount'] - $data['amount_residual'] - $data['discount_amount'];
            } elseif ($total == 0) {
				$data['amount'] = $data['amount'] - $data['deductibles_amount'] - $data['amount_residual'];
			}
			
			if ($data['discount_type'] == 1 && $total == 1) {
			    $data['amount'] = ($data['amount'] - $data['deductibles_amount']) * (100 - $data['discount_percent']) / 100;
            } elseif ($data['discount_type'] == 2 && $total == 1) {
                $data['amount'] = $data['amount'] - $data['deductibles_amount'] - $data['discount_amount'];
            } elseif ($total == 1) {
				$data['amount'] = $data['amount'] - $data['deductibles_amount'];
			}
			
			$data['amount'] = $data['amount'] + $data['amount_compensation'] + $data['amount_evacuate'];

            $data['amount'] = $this->roundNumber($data['amount'], 2);
//_dump($data['amount']);
			if ($data['amount'] < 0) {
				$data['amount'] = 0;
			}
			//конец расчета суммы возмещения
		} else {
            //расчет франшизи в делах без выплат
            $list = $this->getPolicyValues($data['accidents_id'], $data);

            if($data['policies_options_deductible_glass_no'] == 1 && !$data['deductibles_change']){
                $data['deductibles_amount'] = 0;
            } else{
                if($data['risks_id'] == RISKS_HIJACKING1 ) {
                    if($list['deductibles_absolute1'] == 0) {
                        $data['deductibles_amount'] = $list['policies_price'] * $list['policies_deductibles_value1'] / 100 ;
                    } else {
                        $data['deductibles_amount'] = $list['policies_deductibles_value1'] ;
                    }
                } else {
                    if($list['deductibles_absolute0'] == 0) {
                        $data['deductibles_amount'] = $list['policies_price'] * $list['policies_deductibles_value0'] / 100 ;
                    } else {
                        $data['deductibles_amount'] = $list['policies_deductibles_value0'] ;
                    }
                }
            }//конец расчета франшизи

			$data['amount_compensation']		= 0;
			$data['market_price']				= $data['insurance_price'];
			$data['proportionality_value'] 		= 1;
			$data['deterioration_value'] 		= 0;
			$data['deterioration_basis'] 		= '';
			$data['extent_damage_percent'] 		= 0;
			$data['amount_residual']			= 0;
			$data['payment_document_number']	= '';
			//$data['payment_document_date']		= '';
			$data['amount_details']				= 0;
			$data['amount_material']			= 0;
			$data['amount_work']				= 0;
			$data['amount']						= 0;
            $data['amount_expertize']           = 0;
            $data['amount_evacuate']            = 0;
			$data['discount_percent']			= 0;
            $data['discount_amount']			= 0;
			$data['payment_statuses_id']		= PAYMENT_STATUSES_NOT;

			$this->formDescription['fields'][ $this->getFieldPositionByName('payment_document_number') ]['verification']['canBeEmpty'] = true;
			//$this->formDescription['fields'][ $this->getFieldPositionByName('payment_document_date') ]['verification']['canBeEmpty'] = true;
		}

		/*if (intval($data['discount_percent']) == 0) {
			$data['discount_basis'] = '';
			$this->formDescription['fields'][ $this->getFieldPositionByName('discount_basis') ]['verification']['canBeEmpty'] = true;
		}*/

		if ($data['deterioration_value'] <= 0) {
			$this->formDescription['fields'][ $this->getFieldPositionByName('deterioration_basis') ]['verification']['canBeEmpty'] = true;
		}

        $data['payment_document_number'] = str_replace('"', '&quot;', $data['payment_document_number'] );

        $data['act_type'] = (!is_null($data['act_type']) || ($data['amount_previous_acts'] != 0 && $data['insurance'] == 1) || ($data['amount_previous_acts'] == 0 && $data['insurance'] == 1 && $data['acts_count'] != 0)) ? $data['act_type'] : '0';//если не установелно, то присваиваем 0

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

		$sql =	'SELECT a.*, b.* ' .
				'FROM ' . PREFIX . '_accidents_acts as a ' .
                'JOIN ' . PREFIX . '_accidents_kasko_acts as b ON a.id = b.accidents_acts_id ' .
				'WHERE a.accidents_id = ' . intval($accidents_id) . ' AND a.id <> ' . intval($id) . ' ' .
				'LIMIT 1';

		return $db->getRow($sql);
	}

	function checkFields($data, $action) {
		global $Authorization, $Log, $db;

	    parent::checkFields($data, $action);

        if ($data['do'] != $this->object . '|updateApproval') {
            $previous = $this->getPreviousValues($data['id'], $data['accidents_id']);

			if (is_array($previous) && $data['insurance'] == 1) {
				if ($data['market_price'] != $previous['market_price'] && $previous['amount'] > 0 && $data['accidents_id'] != 9376) {
					//$Log->add('error', '<b>Ринкова вартість автомобілю</b> не співпадає з ринковою вартістю за попереднім актом.');
				}

				if ($data['proportionality_value'] != $previous['proportionality_value'] && $previous['amount'] > 0 && $data['accidents_id'] != 15987) {
					//$Log->add('error', '<b>Коефіціент пропорційності</b> не співпадає з коефіціентом пропорційності за попереднім актом.');
				}

				if ($data['deterioration_value'] != $previous['deterioration_value'] && $previous['amount'] > 0 && $data['accidents_id'] != 14230) {
					$Log->add('error', '<b>Коефіціент зносу</b> не співпадає з коефіціентом зносу за попереднім актом.');
				}

				if ($data['extent_damage_percent'] != $previous['extent_damage_percent'] && $previous['amount'] > 0 && $data['accidents_id'] != 15987) {
					$Log->add('error', '<b>Коефіцієнт тотального збитку</b> не співпадає з коефіцієнтом тотального збитку за попереднім актом.');
				}				
            }
			
			//перевірка дати отримання останнього документу
			if (checkdate($data['documents_date_month'], $data['documents_date_day'], intval($data['documents_date_year']))) {
				if (mktime(0, 0, 0, $data['documents_date_month'], $data['documents_date_day'], $data['documents_date_year']) > mktime(0, 0, 0, date('m'), date('d'), date('Y'))) {
					$Log->add('error', '<b>Дата отримання останнього документу</b> не може бути більшою за сьогоднішню.');
				}
			} elseif ($this->formDescription['fields'][ $this->getFieldPositionByName('documents_date') ]['display']['update']) {
				$Log->add('error', '<b>Дата отримання останнього документу</b> обов\'язкова для заповнення.');
			}
			
			//перевірка термінів
			if ($data['upproval_term'] < 0) {
				//$Log->add('error', '<b>Кількість робочих днів на прийняття рішення</b> не може бути від\'ємною.');
			}
			if ($data['payment_term'] < 0) {
				//$Log->add('error', '<b>Кількість робочих днів на виплату</b> не може бути від\'ємною.');
			}

			if ($data['act_type'] == ACCIDENT_INSURANCE_ACT_TYPE_RETURN_PARTIAL) {
				$sql = 'SELECT amount FROM ' . PREFIX . '_accidents_acts WHERE new_acts_id = ' . intval($data['id']);
				if (round($this->roundNumber($data['amount'], 2), 2) >= $db->getOne($sql)) {
					$Log->add('error', 'Сума за актом повинна бути меншою ніж за попереднім.');
				}
			}
        } else {
			if (checkdate($data['date_month'], $data['date_day'], intval($data['date_year']))) {
				if (mktime(0, 0, 0, $data['date_month'], $data['date_day'], $data['date_year']) > mktime(0, 0, 0, date('m'), date('d'), date('Y'))) {
					//$Log->add('error', '<b>Дата прийняття рішення</b> не може бути більшою за сьогоднішню.');
				}
				
				$sql = 'SELECT date_format(MAX(created), \'%Y-%m-%d\') FROM ' . PREFIX . '_accident_status_changes WHERE accidents_id = ' . intval($data['accidents_id']);
				$last_changes = $db->getOne($sql);
				
				if (mktime(0, 0, 0, $data['date_month'], $data['date_day'], $data['date_year']) < strtotime($last_changes)) {
					//$Log->add('error', '<b>Дата прийняття рішення</b> не може бути меншою за останню дату з історії.');
				}
				
				if (mktime(0, 0, 0, $data['date_month'], $data['date_day'], $data['date_year']) - strtotime($last_changes) > 60 * 60 * 24 * 21) {
					//$Log->add('error', 'Між <b>датою прийняття рішення</b> та датою, коли було проведено розгляд, не може бути більше 21 дня.');
				}
			}			
		}

		$PaymentsCalendar = new AccidentPaymentsCalendar($data);

		foreach ($data['payments_calendar'] as $payment) {

			$values = array();

			$values['accounts_id']	= $Authorization->data['id'];
			$values['accidents_id']	= $data['accidents_id'];
			$values['acts_id']		= $data['id'];

			$values = array_merge($values, $payment);

            //проверяем есть ли полис с таким номером, если нет - выводим сообщение об ошибке
            if($payment['payment_types_id'] == PAYMENT_TYPES_PART_PREMIUM) {
                $sql  =  'SELECT date '.
                         'FROM ' . PREFIX . '_policies ' .
                         'WHERE number = ' . $db->quote($payment['policies_number']);
                $payment['policies_date_format'] = $db->getOne($sql);
                if(empty($payment['policies_date_format'])){
					$Log->add('error', 'Договору страхування <b>'. $payment['policies_number'].'</b> не існує');
                }
            }
			$PaymentsCalendar->setConstants($values);
			$PaymentsCalendar->checkFields($values, 'insert');

			$amount = $amount + $payment['amount'];

		}

		if (round($this->roundNumber($data['amount'], 2), 2) != round($this->roundNumber($amount, 2), 2)) {
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


/*
	//фиксируем суммы по выплаченным страховым актам
	function setAmount($accidents_id) {
		global $db;

		$sql =	'SELECT SUM(amount) ' .
				'FROM ' . PREFIX . '_accidents_kasko_acts ' .
				'WHERE accidents_id = ' . intval($accidents_id);
		$amount = $db->getOne($sql);

		$sql =	'UPDATE ' . PREFIX . '_accidents SET ' .
				'amount = ' . $db->quote($amount) . ' ' .
				'WHERE id = ' . intval($accidents_id);
		$db->query($sql);
	}
*/

	function setAdditionalFields($id, $data) {
		global $db, $Log;

		if (intval($data['accident_messages_id'])) {
			$sql = 'UPDATE ' . PREFIX . '_accidents_acts ' .
				   'SET accident_messages_id = ' . intval($data['accident_messages_id']) . ' ' . 
				   'WHERE id = ' . intval($id);
			$db->query($sql);
		}

		$PaymentsCalendar = new AccidentPaymentsCalendar($data);

		$PaymentsCalendar->mode = true;
        $PaymentsCalendar->permissions['insert'] = true;
		$PaymentsCalendar->permissions['update'] = true;

		$PaymentsCalendar->changeActPayments($id, $data);

		$this->updateDocumentTypes($id, $data);

        $product_document_types[] = DOCUMENT_TYPES_ACCIDENT_INSURANCE_ACT;
        $current_amount = (round($data['amount_details'] * (1 - $data['deterioration_value']), 2) + $data['amount_material'] + $data['amount_work']) * $data['proportionality_value'];
        if ($data['insurance'] == 1 && $data['extent_damage_percent'] <= $current_amount / $data['price'] * 100) {
            $product_document_types[] = DOCUMENT_TYPES_ACCIDENT_TOTAL_LETTER;
        }

		Accidents::generateDocuments($data['accidents_id'], 0, 0, $data['id'], $product_document_types);

		$Accidents_KASKO = Accidents::factory($data, 'KASKO');		
		
		if (in_array($Accidents_KASKO->getAccidentStatusesId($data['accidents_id']), array(ACCIDENT_STATUSES_COMPROMISE_AGREEMENT, ACCIDENT_STATUSES_INVESTIGATION, ACCIDENT_STATUSES_REINVESTIGATION, ACCIDENT_STATUSES_COMPROMISE_CONTINUE)) && $data['act_statuses_id'] != ACCIDENT_STATUSES_INVESTIGATION) {
			$Accidents = new Accidents($data);
			$Accidents->changeAccidentStatus($data['accidents_id'], $data['act_statuses_id']);
		}
		
		if (in_array($data['act_statuses_id'], array(ACCIDENT_STATUSES_INVESTIGATION, ACCIDENT_STATUSES_APPROVAL, ACCIDENT_STATUSES_COORDINATION)) && in_array($data['insurance'], array(2, 3))) {
			$sql = 'UPDATE ' . PREFIX . '_accidents_acts as accidents_acts, ' . PREFIX . '_accidents as accidents ' .
				   'SET accidents_acts.reason = accidents.reason, accidents_acts.reason_not_payment = accidents.reason_not_payment ' .
				   'WHERE accidents_acts.accidents_id = accidents.id AND accidents.id = ' . intval($data['accidents_id']) . ' AND accidents_acts.id = ' . intval($id);
			$db->query($sql);
		}
		
		$sql = 'SELECT COUNT(*) FROM ' . PREFIX . '_accident_payments_calendar WHERE recipient_types_id = 5 AND payment_types_id = 6 AND acts_id = ' . intval($id) . ' GROUP BY acts_id';
		if (intval($db->getOne($sql)) > 0) {
			$sql = 'UPDATE ' . PREFIX . '_accidents_acts SET in_repair = 1 WHERE id = ' . intval($id);
		} else {
			$sql = 'UPDATE ' . PREFIX . '_accidents_acts SET in_repair = 0 WHERE id = ' . intval($id);
		}
		$db->query($sql);
		
		if (intval($data['old_acts_id'])) {
			$sql = 'UPDATE ' . PREFIX . '_accidents_acts SET new_acts_id = ' . intval($data['id']) . ' WHERE id = ' . intval($data['old_acts_id']);
			$db->query($sql);
		}
		
		if ($data['act_statuses_id'] == ACCIDENT_STATUSES_COORDINATION && $data['insurance'] == 1) {	
			$this->setCarServicesRequest($id, $data);
		}
    }
	
	function setCarServicesRequest($id, $data) {
		global $db, $Log;
		
		$sql = 'SELECT request_id FROM ' . PREFIX . '_accidents_acts WHERE id = ' . intval($id);
		$request_id = $db->getOne($sql);
		$sql = 'SELECT accident_messages_id FROM ' . PREFIX . '_accidents_acts WHERE id = ' . intval($id);
		$accident_messages_id = $db->getOne($sql);

		$sql = 'SELECT * FROM ' . PREFIX . '_accident_messages WHERE id = ' . intval($accident_messages_id);
		$message = $db->getRow($sql);
		$answer = unserialize($message['answer']);

		if (intval($message['recipient_roles_id']) == ROLES_MASTER && !intval($request_id) && isset($answer['repair_parts']) && $answer['repair_parts'] == 'on') {								
			$Log->clear();
			$AccidentMessages = new AccidentMessages($data);
			$request_id = $AccidentMessages->insert(array(
				'product_types_id' => PRODUCT_TYPES_KASKO,
				'message_types_id' => ACCIDENT_MESSAGE_TYPES_CAR_SERVICES_REQUEST, 
				'statuses_id' => ACCIDENT_MESSAGE_STATUSES_QUESTION, 
				'curators_id' => $message['curators_id'],
				'accidents_id' => $data['accidents_id'],
				'calculation_car_services_id' => $message['car_services_id'],
				'recipients_id' => 0,
				'recipient' => ''
				) , false);
			$sql = 'UPDATE ' . PREFIX . '_accidents_acts SET request_id = ' . intval($request_id) . ' WHERE id = ' . intval($id);
			$db->query($sql);
			$Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
		}
	}

    function insert($data, $redirect=true) {
        global $Log;

		parent::insert($data, false, true, true);

        if (!$Log->isPresent()) {

			$this->setFields();

		    $data['id'] = parent::insert($data, false);

			if ($data['id']) {

				$this->setNumber($data['accidents_id'], $data['id'], $data);
				$this->setAdditionalFields($data['id'], $data);
				$this->setTheoryLimitPaymentDate($data['id'], 2);

				

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
            $data['policy_payments_calendar'] = Accidents::getPolicyPaymentsCalendar($data['policies_number'], $data['policies_id'], $data['policies_product_types_id']);
            $data['accidents_date_values'] = Accidents::getAccidentsDateValues($data['accidents_id']);
			$this->showForm($data, 'insert', 'insert');
		}
    }

    function prepareFields($action, &$data) {
		global $db;

        $data = parent::prepareFields($action, $data);

		$sql =	'SELECT b.*, a.*, d.*, c.insurance, c.id as accidents_id, ' .
                'a.insurance as act_insurance, ' .
				'date_format(datetime_average, ' . $db->quote(DATETIME_FORMAT) . ') AS datetime_average_format, date_format(datetime_average, \'%Y\') AS datetime_average_year, date_format(datetime_average, \'%m\') AS datetime_average_month, date_format(datetime_average, \'%d\') AS datetime_average_day, date_format(datetime_average, \'%k\') AS datetime_average_hour, date_format(datetime_average, \'%i\') AS datetime_average_minute, ' .
				'date_format(mvs_date_average, ' . $db->quote(DATETIME_FORMAT) . ') AS mvs_date_average_format, date_format(mvs_date_average, \'%Y\') AS mvs_date_average_year, date_format(mvs_date_average, \'%m\') AS mvs_date_average_month, date_format(mvs_date_average, \'%d\') AS mvs_date_average_day, ' .
				'description_average, criminal, regres ' .
				'FROM ' . PREFIX . '_accidents_acts AS a ' .
                'JOIN ' . PREFIX . '_accidents_kasko_acts as d ON a.id = d.accidents_acts_id ' .
				'JOIN ' . PREFIX . '_accidents_kasko AS b ON a.accidents_id = b.accidents_id ' .
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

		$sql =	'SELECT a.*, SUM(b.amount) AS payed_amount, c.tis as car_services_tis ' .
				'FROM ' . PREFIX . '_accident_payments_calendar AS a ' .
				'LEFT JOIN ' . PREFIX . '_accident_payments AS b ON a.id = b.payments_calendar_id ' .
                'LEFT JOIN ' . PREFIX . '_car_services as c ON a.recipients_id = c.id AND a.recipient_types_id = ' . RECIPIENT_TYPES_CAR_SERVICE . ' ' .
				'WHERE a.acts_id = ' . intval($data['id']) . ' ' .
				'GROUP BY a.id';
		$data['payments_calendar'] = $db->getAll($sql);

        $data['payment_document_number'] = htmlspecialchars_decode($data['payment_document_number']);

        $data['policy_payments_calendar'] = Accidents::getPolicyPaymentsCalendar($data['policies_number'], $data['policies_id'], $data['policies_product_types_id']);
        $data['accidents_date_values'] = Accidents::getAccidentsDateValues($data['accidents_id']);
		
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
			$conditions[] = PREFIX . '_accidents_kasko.mvs_id_average=' . PREFIX . '_mvs.id';

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
                PREFIX . '_accidents_kasko_acts, ' .
				PREFIX . '_accidents_kasko, ' .
                PREFIX . '_accidents, ' .
                PREFIX . '_mvs ' .
				'WHERE ' . PREFIX . '_accidents_kasko_acts.accidents_acts_id = ' . PREFIX . '_accidents_acts.id AND ' . $this->getAssignmentConditions('view', $prefix, ' AND ') . PREFIX . '_' . $identityField['table'] . '.' . $identityField['name'] . '=' . intval($data['id']);

		return parent::view($data, $conditions, $sql, $template, $showForm);
    }

    function update($data, $redirect=true) {
        global $Log, $db;

		parent::update(&$data, false, false, true);

		if (!$Log->isPresent()) {

			$this->setFields();

			$data['id'] = parent::update($data, false);

			if ($data['id']) {
				$data['old_acts_id'] = $db->getOne('SELECT id FROM ' . PREFIX . '_accidents_acts WHERE new_acts_id = ' . intval($data['id']));

		        $this->setNumber($data['accidents_id'], $data['id'], $data);
				$this->setAdditionalFields($data['id'], $data);
				$this->setTheoryLimitPaymentDate($data['id'], 2);
				
				//$this->setAdditionalFields($data['id'], $data);
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
            $data['policy_payments_calendar'] = Accidents::getPolicyPaymentsCalendar($data['policies_number'], $data['policies_id'], $data['policies_product_types_id']);
            $data['accidents_date_values'] = Accidents::getAccidentsDateValues($data['accidents_id']);
			$this->showForm($data, 'update', 'update');
		}
    }

    function change($data, $redirect=true) {
        global $db;

        if (is_array($data['not_proportionality'])){//Якщо поле яке міняємо це - "не враховувати у пропорцію, то пишемо в моніторинг повідомлення"
            $Accidents = new Accidents($data);

            foreach($data['not_proportionality'] as $id=>$value){
                $sql = 'SELECT number ' .
                       'FROM ' . PREFIX . '_accidents_acts ' .
                       'WHERE id = ' . intval($id);
                $act_number = $db->getOne($sql);
                $Accidents->insertAccidentsComment(array('accidents_id'=> $data['accidents_id'], 'monitoring_comment' => '<label style="color:red;"><b>Акт номер: </label>' . $act_number . '</b> не враховується у пропорцію'));
            }
        }
        parent::change($data, $redirect);

    }

    function buildChangeSQL($data, $id) {
        global $db;

        $sql = 'UPDATE ' . $this->tables[0] . ' ' .
               'JOIN ' . $this->tables[1] . ' ON ' . $this->tables[0] . '.id = ' . $this->tables[1] . '.accidents_acts_id SET ';
        foreach ($this->changeFields as $field) {
            switch ($field['type']) {
                case fldInteger:
                    $fields[] .= $field['name'] . ' = ' . intval($data[$field['name']][$id]);
                    break;
                default:
                    $fields[] .= $field['name'] . ' = ' . $db->quote($data[$field['name']][$id]);
            }
        }

        $sql .= implode(', ', $fields) . ' WHERE id = ' . intval($id);

        return $sql;
    }

	function getXML($data) {
		global $db, $Smarty;

		if ($data['number']) {

            $conditions[] = 'a.number = ' . $db->quote($data['number']);
			//$conditions[] = 'a.act_statuses_id = ' . ACCIDENT_STATUSES_PAYMENT;
			$conditions[] = 'a.act_statuses_id IN(' . ACCIDENT_STATUSES_PAYMENT . ', ' . ACCIDENT_STATUSES_RESOLVED . ')';

			$sql =	'SELECT a.*, d.*, a.id AS acts_id, b.number as accidents_number,IF(pd1.product_types_id=10 AND pd1.sub_number>0,CONCAT(pd1.number,\'_\',pd1.sub_number), c.number) AS policies_number   ' .
					'FROM ' . PREFIX . '_accidents_acts AS a ' .
                     'JOIN ' . PREFIX . '_accidents_kasko_acts as d ON a.id = d.accidents_acts_id ' .
					'JOIN ' . PREFIX . '_accidents AS b ON a.accidents_id = b.id ' .
					'JOIN ' . PREFIX . '_policies AS c ON b.policies_id = c.id ' .
					'LEFT JOIN ' . PREFIX . '_policies_drive pd ON pd.policies_id=b.policies_id '.
					'LEFT JOIN ' . PREFIX . '_policies pd1 ON pd.policies_general_id=pd1.id '.
					'WHERE ' . implode(' AND ', $conditions);
		    $list = $db->getAll($sql);

			if (is_array($list)) {
				foreach($list as $i => $row) {

					$sql =	'SELECT * ' .
							'FROM ' . PREFIX . '_accident_payments_calendar ' .
							'WHERE accidents_id = ' . intval($row['accidents_id']) . ' AND acts_id = ' . intval($row['acts_id']).' ORDER BY payment_types_id';
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
	
	function createReturnPartialAct($data) {
		global $db, $Log, $Authorization;
		
		if (is_array($data['id'])) {
			$data['id'] = $data['id'][0];
		}
		
		$sql = 'SELECT IF(SUM(act_statuses_id) / COUNT(*) = 6, 1, 0) ' .
			   'FROM ' . PREFIX . '_accidents_acts ' .
			   'WHERE accidents_id = ' . intval($data['accidents_id']);
		
		if (!intval($db->getOne($sql))) {
			$Log->add('error', 'Страхові акти створювати заборонено');
			header('Location: index.php?do=Accidents|updateActs&accidents_id=' . intval($data['accidents_id']) . '&product_types_id=' . intval($data['product_types_id']));
			exit;
		}
		
		$sql = 'SELECT accidents.accident_statuses_id as accident_statuses_id, acts.act_statuses_id as act_statuses_id, acts.new_acts_id as new_acts_id, kasko_acts.not_proportionality as not_proportionality, SUM(calendar.is_return) as is_return, ' .
					'COUNT(calendar.id) as count_calendar_id, calendar.recipient_types_id as recipient_types_id ' .
			   'FROM ' . PREFIX . '_accidents as accidents ' .
			   'JOIN ' . PREFIX . '_accidents_acts as acts ON accidents.id = acts.accidents_id ' .
			   'JOIN ' . PREFIX . '_accidents_kasko_acts as kasko_acts ON acts.id = kasko_acts.accidents_acts_id ' .
			   'JOIN ' . PREFIX . '_accident_payments_calendar as calendar ON acts.id = calendar.acts_id ' .			   
			   'WHERE accidents.id = ' . intval($data['accidents_id']) . ' AND acts.id = ' . intval($data['id']);
		$check = $db->getRow($sql);
		
		if ($check['accident_statuses_id'] != ACCIDENT_STATUSES_REINVESTIGATION) {
			$Log->add('error', 'Справа повинна знаходитися в статусі <b>Повторний розгляд</b>');
		}
		if ($check['act_statuses_id'] != ACCIDENT_STATUSES_RESOLVED) {
			$Log->add('error', 'Акт повинен знаходитися в статусі <b>Врегульовано</b>');			
		}
		if ($check['is_return'] > 0) {
			$Log->add('error', 'Кошти уже повернуто');			
		}
		if ($check['not_proportionality'] != 1) {
			$Log->add('error', 'Акт повинен не враховуватися у пропорцію');			
		}
		if ($check['new_acts_id'] > 0) {
			$Log->add('error', 'По цьому акту уже було повернення коштів');			
		}
		if ($check['count_calendar_id'] != 1) {
			$Log->add('error', 'Повернення коштів по акту можливе, якщо була виплата і отримувач лише СТО');			
		}
		if ($check['recipient_types_id'] != RECIPIENT_TYPES_CAR_SERVICE) {
			$Log->add('error', 'Повернення коштів по акту можливе, якщо отримувач СТО');			
		}
		
		if ($Log->isPresent()) {
			header('Location: index.php?do=Accidents|updateActs&accidents_id=' . intval($data['accidents_id']) . '&product_types_id=' . intval($data['product_types_id']));
			exit;
		}
		
		$data['partial_return'] = true;
		$data = $this->load($data, false);

		$data['old_acts_id'] = $data['id'];
		$data['act_type'] = ACCIDENT_INSURANCE_ACT_TYPE_RETURN_PARTIAL;
		$data['act_statuses_id'] = ACCIDENT_STATUSES_INVESTIGATION;
		unset($data['id']);		
		
		for ($i = 0; $i < sizeof($data['payments_calendar']); $i++) {
			$data['payments_calendar'][$i]['id'] = -1 - $i;			
			unset($data['payments_calendar'][$i]['acts_id']);
			unset($data['payments_calendar'][$i]['number']);
			unset($data['payments_calendar'][$i]['payment_statuses_id']);
			unset($data['payments_calendar'][$i]['payment_date']);
			unset($data['payments_calendar'][$i]['created']);
			unset($data['payments_calendar'][$i]['modified']);
			unset($data['payments_calendar'][$i]['tasks_id']);
			unset($data['payments_calendar'][$i]['payed_amount']);
		}
		//if($Authorization->data['id']==1){
		//_dump($data);}		
		$this->showForm($data, 'insert', 'insert', null);
	}
	
	function changeNotProportionalityInWindow($data) {
		global $db;
		
		$sql = 'UPDATE ' . PREFIX . '_accidents_kasko_acts ' .
			   'SET not_proportionality = ' . intval($data['value']) . ' ' .
			   'WHERE accidents_acts_id = ' . intval($data['id']);
		$db->query($sql);
		
		
		if (intval($data['value'])) {
			Accidents::insertAccidentsComment(array('accidents_id'=> $data['accidents_id'], 'monitoring_comment' => '<label style="color:red;"><b>Акт номер: </label>' . $this->getNumber($data['id']) . '</b> не враховується у пропорцію'));
		} else {
			Accidents::insertAccidentsComment(array('accidents_id'=> $data['accidents_id'], 'monitoring_comment' => '<label style="color:red;"><b>Акт номер: </label>' . $this->getNumber($data['id']) . '</b> враховується у пропорцію'));
		}
		echo '{"value" : "' . $data['value'] . '", "number" : "' . $this->getNumber($data['id']) . '"}';
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