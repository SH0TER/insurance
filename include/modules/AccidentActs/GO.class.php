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

class AccidentActs_GO extends AccidentActs {

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
						'table'                	=> 'accidents_go_acts'),
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
						'table'                	=> 'accidents_go_acts'),
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
						'name'                	=> 'market_price',
						'description'        	=> 'Ринкова вартість, грн.',
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
						'table'                	=> 'accidents_go_acts'),
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
						'table'                	=> 'accidents_go_acts'),
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
						'table'                	=> 'accidents_go_acts'),
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
						'table'                	=> 'accidents_go_acts'),
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
						'table'                	=> 'accidents_go_acts'),
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
						'table'                	=> 'accidents_go_acts'),
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
						'orderPosition'			=> 4,
						'table'                	=> 'accidents_go_acts'),
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
						'table'                	=> 'accidents_go_acts'),
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
                     array(
						'name'                	=> 'mtsbu_date',
						'description'        	=> 'МТСБУ',
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
						'table'                	=> 'accidents_go_acts'),
                     array(
                        'name'              => 'mtsbu_date',
                        'description'       => 'МТСБУ',
                        'type'              => fldDate,
                        'display'           =>
                            array(
                                'show'      => true,
                                'insert'    => false,
                                'view'      => false,
                                'update'    => false
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'orderPosition'     => 21,
                        'width'             => 100,
                        'table'             => 'accidents_go'),
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
								'view'        	=> true,
								'update'    	=> true
							),
						'verification'        	=>
							array(
								'canBeEmpty'    => false
							),
						'table'                	=> 'accidents_acts'),
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
						'table'                	=> 'accidents_go_acts'),
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
						'table'					=> 'accidents_go_acts'),
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
						'name'                	=> 'market_price',
						'description'        	=> 'Ринкова вартість, грн.',
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
						'table'                	=> 'accidents_go_acts'),
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
						'table'                	=> 'accidents_go_acts'),
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
						'table'                	=> 'accidents_go_acts'),
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
						'table'                	=> 'accidents_go_acts'),
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
						'table'                	=> 'accidents_go_acts'),
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
						'table'                	=> 'accidents_go_acts'),
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
						'table'                	=> 'accidents_go_acts'),
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
						'table'                	=> 'accidents_go_acts'),
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
						'orderPosition'			=> 4,
						'table'                	=> 'accidents_go_acts'),
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
						'table'                	=> 'accidents_go_acts'),
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
                        'orderPosition'			=> 6,
                        'width'				    => 100,
                        'table'                	=> 'accidents_acts'),
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
                        'table'                 =>  'accidents_go_acts'),
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
						'name'                	=> 'mtsbu_date',
						'description'        	=> 'МТСБУ',
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
						'table'                	=> 'accidents_go_acts'),
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
								'canBeEmpty'    => false
							),
						'orderPosition'			=> 12,
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

    function AccidentActs_GO($data) {
        AccidentActs::AccidentActs($data);

		$this->messages['plural'] = 'Страхові акти';
		$this->messages['single'] = 'Страховий акт';

		$this->product_types_id = PRODUCT_TYPES_GO;
    }

	function setFields() {
		foreach ($this->formDescription['fields'] as $i => $field) {
			if ( $field['table'] != 'accidents_acts' && $field['table'] != 'accidents_go_acts' && $field['table'] != 'accidents_acts_transfer') {
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
				'b.accidents_id, b.address, b.mvs_average, b.mvs_id_average, IF(b.owner_person_types_id = 1, CONCAT_WS(\' \', b.owner_lastname, b.owner_firstname, b.owner_patronymicname), b.owner_lastname) as accidents_owner, b.owner_identification_code, ' .
//				'c.number AS policies_number, date_format(c.date, ' . $db->quote(DATE_FORMAT) . ') AS policies_date_format, date_format(c.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') AS policies_begin_datetime_format, date_format(c.interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') AS policies_interrupt_datetime_format, c.price AS policies_price, c.amount AS policies_amount, ' .
				'c.number AS policies_number, date_format(c.date, ' . $db->quote(DATE_FORMAT) . ') AS policies_date_format, date_format(c.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') AS policies_begin_datetime_format, date_format(c.interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') AS policies_interrupt_datetime_format, c.amount AS policies_amount, ' .
				'd.deductible, d.insurer_lastname AS policies_insurer_lastname, d.insurer_firstname AS policies_insurer_firstname, d.insurer_patronymicname AS policies_insurer_patronymicname, ' .
				'SUM(f.amount) AS policy_payments_amount ' .
				'FROM ' . PREFIX . '_accidents AS a ' .
				'JOIN ' . PREFIX . '_accidents_go AS b ON a.id = b.accidents_id ' .
				'JOIN ' . PREFIX . '_policies AS c ON a.policies_id = c.id ' .
				'JOIN ' . PREFIX . '_policies_go AS d ON a.policies_id = d.policies_id ' .
				'LEFT JOIN ' . PREFIX . '_policy_payments AS f ON a.policies_id = f.policies_id ' .
				'WHERE a.id = ' . intval($id) . ' ' ;
				'GROUP BY f.policies_id';
		$row =	$db->getRow($sql);

		$Accidents = Accidents::factory($data, 'GO');

		$row['insurance_price'] = 50000;//($row['policies_options_agregate_no'] == 1) ? $row['policies_price'] : $row['policies_price'] - $Accidents->getAmountPrevious($row['accidents_id']);
		$row['amount_previous_accidents'] = $Accidents->getAmountPrevious($row['accidents_id']);

		if ($id == '1986') {
			$row['insurance_price'] = $row['policies_price'];
		}
 
		return $row;
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
		
		$sql = 'SELECT amount ' .
			   'FROM ' . PREFIX . '_accidents_acts ' .
			   'WHERE id = ' . intval($id);
		$amount_this = floatval($db->getOne($sql));
		
		$sql = 'SELECT getCompensation(' . intval($accidents_id) . ', 4)';
		$amount_total = floatval($db->getOne($sql));
		
		$amount = $amount_total - $amount_this;

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
                'JOIN ' . PREFIX . '_accidents_go_acts as b ON a.id = b.accidents_acts_id ' .
				'WHERE a.accidents_id = ' . intval($accidents_id) . ' ' .
				'ORDER BY a.id DESC ' .
				'LIMIT 1';
		return	$db->getRow($sql, 30 * 60);
	}

    function showForm($data, $action, $actionType=null, $template=null) {

		if (is_null($template)) {
			$template = 'goInvestigation.php';
		}

		$data['accidents'] = Accidents::factory($data, 'GO');

		$data['accident_statuses_id'] = $data['act_statuses_id'];
		$this->formDescription['fields'][ $this->getFieldPositionByName('act_statuses_id') ]['verification']['canBeEmpty'] = false;
		$this->formDescription['fields'][ $this->getFieldPositionByName('act_statuses_id') ]['list'] = $data['accidents']->getListValue($data['accidents']->formDescription['fields'][ $data['accidents']->getFieldPositionByName('accident_statuses_id') ], $data);

		$data['risks'] = $data['accidents']->getRisks($data['accidents_id']);

        if($data['message_types_id']) {// убираем id из data если акт создается из задачи по Расчету. Так как в функцию подсчета суммы предыдущих актов лезет id задачи.
            unset($data['id']);
        }

        $data['important_person'] = Accidents::getImportantPerson($data['policies_id']);
		$data['amount_previous_acts'] = $this->getAmountPrevious($data['accidents_id'], $data['id']);

		if ($data['amount_previous_acts'] > 0) {
			$data = array_merge($data, $this->getPrevious($data['accidents_id']));
		}

        return parent::showForm($data, $action, $actionType, $template);
    }

	function getMVSDocument($accidents_id) {
		global $db;

		$sql =	'SELECT mvs_average, mvs_title_average ' .
				'FROM ' . PREFIX . '_accidents_go ' .
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
        global $db, $Authorization;

         //запрет создания актов, если есть акты в статусах "Розгляд" или "Затвердження"
        $sql = 'SELECT count(id) ' .
               'FROM ' . PREFIX . '_accidents_acts ' .
               'WHERE  accidents_id = ' . $data['accidents_id'] . ' AND act_statuses_id IN ( ' . ACCIDENT_STATUSES_INVESTIGATION.', ' . ACCIDENT_STATUSES_APPROVAL.', ' . ACCIDENT_STATUSES_COORDINATION . ')';
        if(intval($db->getOne($sql)) > 0 && $Authorization->data['roles_id'] != ROLES_ADMINISTRATOR || !in_array(Accidents::getAccidentStatusesId($data['accidents_id']), array(ACCIDENT_STATUSES_INVESTIGATION, ACCIDENT_STATUSES_REINVESTIGATION))) {
           $this->permissions['insert'] = false;
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
        //_dump($data['deterioration_value']);
        if ($showForm) {
            $this->showForm($data, $action, $actionType, $template);
        } else {
            return $data;
        }
      
    }

	function setConstants(&$data) {

		parent::setConstants($data);

        //получаем данные по полису
        $row = $this->getPolicyValues($data['accidents_id'], $data);

        //если случай страховой с выплатой
		if (intval($data['insurance']) == 1) {

			//начало расчета суммы возмещения

			$Accidents = Accidents::factory($data, 'GO');

			$data['amount_previous_accidents'] = $Accidents->getAmountPrevious($data['accidents_id']);

			$data['amount_previous_acts'] = $this->getAmountPrevious($data['accidents_id'], $data['id']);

			//вычисляем сумму страхового возмещения без учета франшизы
            $data['billAmount'] = $data['amount_details'] + $data['amount_material'] + $data['amount_work'];
			$data['amount'] = $data['amount_details'] * (1 - $data['deterioration_value']) + $data['amount_material'] + $data['amount_work'] + $data['amount_compensation'];
//_dump($data['amount']);exit;
            //$data['amount'] = $data['amount'];//учет предыдущих выплат по делу			
			
			//$data['amount'] = $data['amount'] - $data['discount'];
			//$data['amount'] = $data['amount'] + $data['amount_compensation'];//евакуатор

            $total = ($data['amount_details'] + $data['amount_material'] + $data['amount_work'] >= $data['market_price']) ? 1 : 0;
			$dataCheckTemp = "19.02.2016";
//_dump($data['risks_id'] == 1 && $data['amount'] > 50000 && $data['market_price'] - $data['amount_residual'] > 50000);
            if($row['mvs_average'] == 4 && $data['amount'] > 25000 && $data['market_price'] - $data['amount_residual'] > 25000 && strtotime($data['datetime_datetime_format']) < strtotime($dataCheckTemp)) {//если оформление дела по европротоколу, то максимальная сумма 25 тыс. грн.
                $data['amount'] = 25000;
                $data['amount_residual'] = 0;
			}elseif($row['mvs_average'] == 4 && $data['amount'] > 50000 && $data['market_price'] - $data['amount_residual'] > 50000 && strtotime($data['datetime_datetime_format']) >= strtotime($dataCheckTemp)) {//если оформление дела по европротоколу, то максимальная сумма 25 тыс. грн.
                $data['amount'] = 50000;
                $data['amount_residual'] = 0;
            }elseif($data['mvs_average'] >= 1 && $row['mvs_average'] != 4 && $data['risks_id'] == 1 && $data['amount'] > 50000 && $data['market_price'] - $data['amount_residual'] > 50000 && strtotime($data['policies_begin_datetime_format']) < strtotime($dataCheckTemp)) {//если не европротокол и риск - Майно
                $data['amount'] = 50000;
                $data['amount_residual'] = 0;
			}elseif($data['mvs_average'] >= 1 && $row['mvs_average'] != 4 && $data['risks_id'] == 1 && $data['amount'] > 100000 && $data['market_price'] - $data['amount_residual'] > 100000 && strtotime($data['policies_begin_datetime_format']) >= strtotime($dataCheckTemp)) {//если не европротокол и риск - Майно
                $data['amount'] = 100000;
                $data['amount_residual'] = 0;
            }elseif($data['mvs_average'] >= 1 && $row['mvs_average'] != 4 && $data['isks_id'] == 2 && $data['amount'] > 100000 && $data['market_price'] - $data['amount_residual'] > 100000 && strtotime($data['policies_begin_datetime_format']) < strtotime($dataCheckTemp)) {//если не европротокол и риск - Зроровье
                $data['amount'] = 100000;
                $data['amount_residual'] = 0;
			}elseif($data['mvs_average'] >= 1 && $row['mvs_average'] != 4 && $data['isks_id'] == 2 && $data['amount'] > 200000 && $data['market_price'] - $data['amount_residual'] > 200000 && strtotime($data['policies_begin_datetime_format']) >= strtotime($dataCheckTemp)) {//если не европротокол и риск - Зроровье
                $data['amount'] = 200000;
                $data['amount_residual'] = 0;
            }else{
                if($total == 1) $data['amount'] = $data['market_price'];
                else $data['amount_residual'] = 0;
            }

			//учет предыдущих выплат по делу
			if (intval($data['act_type']) == 1) {
				$data['amount'] = $data['amount'] - $data['amount_previous_acts'];
			}			
            $data['amount'] = roundNumber($data['amount'] - $data['deductibles_amount'] - $data['discount'] - $data['amount_residual'], 2);

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
			//$data['payment_document_date']		= '';
			$data['amount_details']				= 0;
			$data['amount_material']			= 0;
			$data['amount_work']				= 0;
            $data['discount']			= 0;
			$data['amount']						= 0;
            $data['amount_expertize']           = 0;
            $data['amount_evacuate']            = 0;
			$data['payment_statuses_id']		= PAYMENT_STATUSES_NOT;
            $data['deductibles_amount']		    = 0;


			$this->formDescription['fields'][ $this->getFieldPositionByName('payment_document_number') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('amount_residual') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('market_price') ]['verification']['canBeEmpty'] = true;
			//$this->formDescription['fields'][ $this->getFieldPositionByName('payment_document_date') ]['verification']['canBeEmpty'] = true;
		}

        $data['payment_document_number'] = str_replace('"', '&quot;', $data['payment_document_number'] );

        $data['act_type'] = ($data['amount_previous_acts'] != 0) ? $data['act_type'] : '0';//если не установелно, то присваиваем 0

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
				'FROM ' . PREFIX . '_accidents_acts as a ' .
                'JOIN ' . PREFIX . '_accidents_go_acts as b ON a.id = b.accidents_acts_id ' .
				'WHERE accidents_id = ' . intval($accidents_id) . ' AND id <> ' . intval($id) . ' ' .
				'LIMIT 1';
		return $db->getRow($sql);
	}

	function checkFields($data, $action) {
		global $Authorization, $Log, $db;

	    parent::checkFields($data, $action);

        if ($data['do'] != $this->object . '|updateApproval') {
            $previous = $this->getPreviousValues($data['id'], $data['accidents_id']);

			if (is_array($previous)) {
				if ($data['market_price'] != $previous['market_price'] && $previous['amount'] > 0) {
					//$Log->add('error', '<b>Ринкова вартість автомобілю</b> не співпадає з ринковою вартістю за попереднім актом.');
				}

				if ($data['proportionality_value'] != $previous['proportionality_value'] && $previous['amount'] > 0) {
					$Log->add('error', '<b>Коефіціент пропорційності</b> не співпадає з коефіціентом пропорційності за попереднім актом.');
				}

				/*if ($data['deterioration_value'] != $previous['deterioration_value'] && $previous['amount'] > 0) {
					$Log->add('error', '<b>Коефіціент зносу</b> не співпадає з коефіціентом зносу за попереднім актом.');
				}*/				
            }
			
			//перевірка дати отримання останнього документу
			if (checkdate($data['documents_date_month'], $data['documents_date_day'], intval($data['documents_date_year']))) {
				if (mktime(0, 0, 0, $data['documents_date_month'], $data['documents_date_day'], $data['documents_date_year']) > mktime(0, 0, 0, date('m'), date('d'), date('Y'))) {
					$Log->add('error', '<b>Дата отримання останнього документу</b> не може бути більшою за сьогоднішню.');
				}
			} else {
				//$Log->add('error', '<b>Дата отримання останнього документу</b> обов\'язкова для заповнення.');
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

			$PaymentsCalendar->setConstants($values);
			$PaymentsCalendar->checkFields($values, 'insert');

			$amount = $amount + $payment['amount'];

		}


		if ($data['insurance'] == 1 && round($data['amount'], 2) != round($amount, 2)) {
			$Log->add('error', 'Сума збитків відрізняється від суми відшкодування. '.$data['amount'].' <> '.$amount);
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
				'FROM ' . PREFIX . '_accidents_go_acts ' .
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

		//Accidents::generateDocuments($data['accidents_id'], 0, 0, $data['id'], array(DOCUMENT_TYPES_ACCIDENT_INSURANCE_GO_ACT));

		$documents = array();
		$documents[] = DOCUMENT_TYPES_ACCIDENT_INSURANCE_GO_ACT;
		
		if (intval($this->getActType($id)) == 0 && $this->getActAmount($id) > 0) {
			$documents[] = DOCUMENT_TYPES_NOTIFICATION_PAYMENTS_GO;
		}
		
		Accidents::generateDocuments($data['accidents_id'], 0, 0, $data['id'], $documents);

		$Accidents = new Accidents($data);
		$Accidents->changeAccidentStatus($data['accidents_id'], $data['act_statuses_id']);
		
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
                'JOIN ' . PREFIX . '_accidents_go_acts as d ON a.id = d.accidents_acts_id ' .
				'JOIN ' . PREFIX . '_accidents_go AS b ON a.accidents_id = b.accidents_id ' .
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
			ACCIDENT_STATUSES_RESOLVED,
			ACCIDENT_STATUSES_TRANSFER_INSURANCE_COMPANY);

		$data['act_statuses_id'] = (!in_array($data['act_statuses_id'], $act_statuses)) ? ACCIDENT_STATUSES_INVESTIGATION : $data['act_statuses_id'];

		$sql =	'SELECT a.*, SUM(b.amount) AS payed_amount, c.tis as car_services_tis ' .
				'FROM ' . PREFIX . '_accident_payments_calendar AS a ' .
				'LEFT JOIN ' . PREFIX . '_accident_payments AS b ON a.id = b.payments_calendar_id ' .
                'LEFT JOIN ' . PREFIX . '_car_services as c ON a.recipients_id = c.id AND a.recipient_types_id = ' . RECIPIENT_TYPES_CAR_SERVICE . ' ' .
				'WHERE a.acts_id = ' . intval($data['id']) . ' ' .
				'GROUP BY a.id';
		$data['payments_calendar'] = $db->getAll($sql);

        $data['payment_document_number'] = htmlspecialchars_decode($data['payment_document_number']);

        return $data;
    }

    function getAssignmentConditions($action, $prefixSQL='', $postfixSQL='') {
		if ($action == 'view') {
			$conditions[] = PREFIX . '_accidents_acts.accidents_id = ' . PREFIX . '_accidents.id';
			$conditions[] = PREFIX . '_accidents_go.mvs_id_average=' . PREFIX . '_mvs.id';

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
                PREFIX . '_accidents_go_acts, ' .
				PREFIX . '_accidents_go, ' .
                PREFIX . '_accidents, ' .
                PREFIX . '_mvs ' .
				'WHERE ' . PREFIX . '_accidents_go_acts.accidents_acts_id = ' . PREFIX . '_accidents_acts.id AND ' . $this->getAssignmentConditions('view', $prefix, ' AND ') . PREFIX . '_' . $identityField['table'] . '.' . $identityField['name'] . '=' . intval($data['id']);

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
				'FROM ' . PREFIX . '_accidents_go_acts ' .
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
			//$conditions[] = 'a.act_statuses_id = ' . ACCIDENT_STATUSES_PAYMENT;
			$conditions[] = 'a.act_statuses_id IN(' . ACCIDENT_STATUSES_PAYMENT . ', ' . ACCIDENT_STATUSES_RESOLVED . ')';

			$sql =	'SELECT a.*, a.id AS acts_id, b.number as accidents_number,c.number as policies_number,b1.owner_lastname,b1.owner_firstname,b1.owner_patronymicname,b1.owner_identification_code ' .
					'FROM ' . PREFIX . '_accidents_acts AS a ' .
					 'JOIN ' . PREFIX . '_accidents_go_acts as d ON a.id = d.accidents_acts_id ' .
					'JOIN ' . PREFIX . '_accidents AS b ON a.accidents_id = b.id ' .
					'JOIN ' . PREFIX . '_accidents_go AS b1 ON b.id = b1.accidents_id ' .
					'JOIN ' . PREFIX . '_policies AS c ON b.policies_id = c.id ' .
					'WHERE ' . implode(' AND ', $conditions);
		    $list = $db->getAll($sql);

			if (is_array($list)) {
				foreach($list as $i => $row) {

				$list[ $i ]['act_recipient0' ] = $row['owner_lastname'].' '.$row['owner_firstname'].' '.$row['owner_patronymicname'];
				$list[ $i ]['act_recipient_identification_code0' ] = $row['owner_identification_code'];
				$list[ $i ]['act_recipient_types_id0'] = $payment['recipient_types_id'];
				$list[ $i ]['act_recipient_types_id0'  ] = 0;
 
							
					$sql =	'SELECT * ' .
							'FROM ' . PREFIX . '_accident_payments_calendar ' .
							'WHERE accidents_id = ' . intval($row['accidents_id']) . ' AND acts_id = ' . intval($row['acts_id']);
					$payments = $db->getAll($sql);

					if (is_array($payments)) {
						foreach($payments as $j=>$payment) {
						if ($j==0) 	$list[ $i ]['act_amount' . $j] = $payment['amount'];
							
							$list[ $i ]['act_recipient' . ($j+1)] = $payment['recipient'];
							$list[ $i ]['act_recipient_identification_code' . ($j+1)] = $payment['recipient_identification_code'];
							$list[ $i ]['act_recipient_types_id' . ($j+1)] = $payment['recipient_types_id'];
							$list[ $i ]['act_amount' . ($j+1)] = $payment['amount'];
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
		
		$sql = 'SELECT accidents.accident_statuses_id as accident_statuses_id, acts.act_statuses_id as act_statuses_id, acts.new_acts_id as new_acts_id, SUM(calendar.is_return) as is_return, ' .
					'COUNT(calendar.id) as count_calendar_id, calendar.recipient_types_id as recipient_types_id ' .
			   'FROM ' . PREFIX . '_accidents as accidents ' .
			   'JOIN ' . PREFIX . '_accidents_acts as acts ON accidents.id = acts.accidents_id ' .
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
	
	function setTheoryLimitPaymentDate($id, $type) {
		global $db;
		
		switch ($type){
			case 1:
				//$date = $db->getOne('SELECT date FROM ' . PREFIX . '_accidents_acts WHERE id = ' . intval($id));
				$date = $db->getOne('SELECT documents_date FROM ' . PREFIX . '_accidents_acts WHERE id = ' . intval($id));
				$total_term = 90;//$db->getOne('SELECT payment_term FROM ' . PREFIX . '_accidents_acts WHERE id = ' . intval($id));
				break;
			case 2:
				$date = $db->getOne('SELECT documents_date FROM ' . PREFIX . '_accidents_acts WHERE id = ' . intval($id));
				$total_term = 90;//$db->getOne('SELECT approval_term + payment_term FROM ' . PREFIX . '_accidents_acts WHERE id = ' . intval($id));
				break;
		}
		
		$sql = 'UPDATE ' . PREFIX . '_accident_payments_calendar ' .
			   'SET theory_limit_payment_date = ADDDATE(' . $db->quote($date) .  ', INTERVAL 90 DAY)' . ' ' .
			   'WHERE acts_id = ' . intval($id);
		$db->query($sql);
	}
	
	function getLimitsDateInWindow($data) {
		if ($data['documents_date'] != '0000-00-00' && $data['documents_date'] != '' && $data['documents_date'] != '..') {
			$limit_payment_date = date('d.m.Y', strtotime('+ 90 day', strtotime($data['documents_date'])));
		} else {
			$limit_approval_date = '';
		}
		echo '{"limit_payment_date" : "' . $limit_payment_date . '"}';
	}
}

?>