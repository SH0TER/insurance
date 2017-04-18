<?
/*
 * Title: agent class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Users.class.php';
require_once 'Policies.class.php';

class Agents extends Users {

    var $roles_id = ROLES_AGENT;

    var $formDescription =
            array(
                'fields'     =>
                    array(
                        array(
                            'name'                => 'id',
                            'type'                => fldIdentity,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => false,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'accounts'),
                        array(
                            'name'                => 'login',
                            'description'        => 'Логін',
                            'type'                => fldLogin,
                            'maxlength'            => 15,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => false,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'accounts'),
                        array(
                            'name'                    => 'password',
                            'description'            => 'Пароль',
                            'additionalDescription'    => 'Ще раз',
                            'type'                    => fldPassword,
                            'maxlength'            => 10,
                            'display'                =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => false,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'accounts'),
                        array(
                            'name'                => 'agencies_id',
                            'description'        => 'Агенція',
                            'type'                => fldHidden,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => false,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'agents'),
                        array(
                            'name'                => 'types_id',
                            'description'        => 'Тип',
                            'type'                => fldRadio,
                            'list'                => array(1 => 'Анкети, звіти', 2 => 'Анкети', 3 => 'Калькулятор'),
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => false,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        => 3,
                            'table'                => 'agents'),
                        array(
                            'name'                => 'lastname',
                            'description'        => 'Прізвище',
                            'type'                => fldText,
                            'maxlength'            => 50,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        => 1,
                            'table'                => 'accounts'),
                        array(
                            'name'                => 'firstname',
                            'description'        => 'Ім\'я',
                            'type'                => fldText,
                            'maxlength'            => 50,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        => 2,
                            'table'                => 'accounts'),
                        array(
                            'name'                => 'patronymicname',
                            'description'        => 'По батьковi',
                            'type'                => fldText,
                            'maxlength'            => 50,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        => 3,
                            'table'                => 'accounts'),
                        array(
                            'name'                => 'phone',
                            'description'        => 'Телефон',
                            'type'                => fldText,
                            'validationRule'    => '^\([0-9]{3,5}\) [0-9]{1,3}-[0-9]{2}-[0-9]{2}',
                            'maxlength'            => 15,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'        => 4,
                            'table'                => 'accounts'),
                        array(
                            'name'                => 'fax',
                            'description'        => 'Факс',
                            'type'                => fldText,
                            'validationRule'    => '^\([0-9]{3,5}\) [0-9]{1,3}-[0-9]{2}-[0-9]{2}',
                            'maxlength'            => 15,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'        => 5,
                            'table'                => 'accounts'),
                        array(
                            'name'                => 'mobile',
                            'description'        => 'Мобільний',
                            'type'                => fldText,
                            'validationRule'    => '^\([0-9]{3,5}\) [0-9]{1,3}-[0-9]{2}-[0-9]{2}',
                            'maxlength'            => 15,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'        => 6,
                            'table'                => 'accounts'),
                        array(
                            'name'                => 'email',
                            'description'        => 'E-mail',
                            'type'                => fldEmail,
                            'maxlength'            => 50,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        => 7,
                            'table'                => 'accounts'),
                        array(
                            'name'                => 'passport_series',
                            'description'        => 'Паспорт. Cерія',
                            'type'                => fldText,
                            'maxlength'            => 2,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'agents'),
                        array(
                            'name'                => 'passport_number',
                            'description'        => 'Паспорт. Номер',
                            'type'                => fldText,
                            'maxlength'            => 6,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'agents'),
                        array(
                            'name'                => 'passport_date',
                            'description'        => 'Паспорт. Дата видачі',
                            'type'                => fldDate,
                            'input'                => true,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'agents'),
                        array(
                            'name'                => 'passport_place',
                            'description'        => 'Паспорт. Місце видачі',
                            'type'                => fldText,
                            'maxlength'            => 100,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'agents'),
                        array(
                            'name'                => 'identification_code',
                            'description'        => 'ІПН',
                            'type'                => fldText,
                            'maxlength'            => 10,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'agents'),
                        array(
                            'name'                => 'address',
                            'description'        => 'Адреса',
                            'type'                => fldText,
                            'maxlength'            => 100,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'agents'),
                        array(
                            'name'                => 'agreement_number',
                            'description'        => 'Номер агенського договору ЭС',
                            'type'                => fldText,
                            'maxlength'            => 20,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'agents'),
                        array(
                            'name'                => 'agreement_date',
                            'description'        => 'Дата агенського договору ЭС',
                            'type'                => fldDate,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'agents'),
						 array(
                            'name'                => 'agreement_number_generali',
                            'description'        => 'Номер агенського договору Гарант-Авто',
                            'type'                => fldText,
                            'maxlength'            => 20,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'agents'),
                        array(
                            'name'                => 'agreement_date_generali',
                            'description'        => 'Дата агенського договору Гарант-Авто',
                            'type'                => fldDate,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'agents'),
                        array(
                            'name'                => 'recipient',
                            'description'        => 'Отримувач',
                            'type'                => fldText,
                            'maxlength'            => 100,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'agents'),
                        array(
                            'name'                => 'mfo',
                            'description'        => 'МФО',
                            'type'                => fldText,
                            'maxlength'            => 6,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'agents'),
                        array(
                            'name'                => 'zkpo',
                            'description'        => 'ЗКПО',
                            'type'                => fldText,
                            'maxlength'            => 10,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'agents'),
                        array(
                            'name'                => 'bank_account',
                            'description'        => 'Рахунок',
                            'type'                => fldText,
                            'maxlength'            => 14,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'agents'),
                        array(
                            'name'                => 'bank_reference',
                            'description'        => 'Призначення платежу',
                            'type'                => fldText,
                            'maxlength'            => 200,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'agents'),
						array(
                            'name'                => 'skr',
                            'description'        => 'Номер картки',
                            'type'                => fldText,
                            'maxlength'            => 16,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'agents'),	
						 array(
                            'name'                => 'cart_date',
                            'description'        => 'Дата дії',
                            'type'                => fldDate,
                            'input'                => true,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'agents'),	
						 array(
                            'name'                => 'bank_name',
                            'description'        => 'Назва банку',
                            'type'                => fldText,
                            'maxlength'            => 200,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'agents'),	
							
							
							
							
						 array(
                            'name'                => 'mfo2',
                            'description'        => 'МФО 2',
                            'type'                => fldText,
                            'maxlength'            => 6,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'agents'),
                        array(
                            'name'                => 'zkpo2',
                            'description'        => 'ЗКПО 2',
                            'type'                => fldText,
                            'maxlength'            => 10,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'agents'),
                        array(
                            'name'                => 'bank_account2',
                            'description'        => 'Рахунок 2',
                            'type'                => fldText,
                            'maxlength'            => 200,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'agents'),

							
                        array(
                            'name'                => 'director1',
                            'description'        => 'Посада, ПІБ у називному відмінку',
                            'type'                => fldText,
                            'maxlength'            => 100,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'agents'),
                        array(
                            'name'                => 'director2',
                            'description'        => 'Посада, ПІБ у родовому відмінку',
                            'type'                => fldText,
                            'maxlength'            => 100,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'agents'),
                        array(
                            'name'                => 'ground_kasko_express',
                            'description'        => 'Договір КАСКО Експрес, діє на підставі',
                            'type'                => fldText,
                            'maxlength'            => 200,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'agents'),
						array(
                            'name'                => 'ground_ns_express',
                            'description'        => 'Договір НВ Експрес, діє на підставі',
                            'type'                => fldText,
                            'maxlength'            => 200,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'agents'),	
						array(
                            'name'                => 'ground_ns_gl',
                            'description'        => 'Договір НВ ГЛ, діє на підставі',
                            'type'                => fldText,
                            'maxlength'            => 200,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'agents'),	
						array(
                            'name'                => 'ground_kasko_generali',
                            'description'        => 'Договір КАСКО Гарант-Авто, діє на підставі',
                            'type'                => fldText,
                            'maxlength'            => 200,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'agents'),
/*
                        array(
                            'name'                => 'ip',
                            'description'        => 'IP',
                            'type'                => fldText,
                            'maxlength'            => 15,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'accounts'),
*/
                        array(
                            'name'                => 'screen_resolutions_id',
                            'description'        => 'Роздільча здатність',
                            'type'                => fldSelect,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'accounts',
                            'sourceTable'        => 'screen_resolutions',
                            'selectField'        => 'title',
                            'orderField'        => 'title'),
                        array(
                            'name'                => 'records_per_page',
                            'description'        => 'Записів на сторінку',
                            'type'                => fldInteger,
                               'validationRule'    => '^([1-4][0-9]|[1-9]|50)$',
                            'maxlength'            => 2,
                            'width'                => 30,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'accounts'),
						array(
                            'name'                => 'correction_go',
                            'description'        => 'Корекцiя полiсу ЦВ',
                            'type'                => fldInteger,
                            'maxlength'            => 3,
                            'width'                => 30,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'accounts'),	
						array(
                            'name'                => 'go_discount',
                            'description'        => 'Розмiр знижки ЦВ',
                            'type'                => fldPercent,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'agents'),	
                        array(
                            'name'                => 'roles_id',
                            'description'        => 'Роль',
                            'type'                => fldConst,
                            'value'                => ROLES_AGENT,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'accounts'),
						array(
                            'name'                => 'ankets',
                            'description'        => 'Анкети',
                            'type'                => fldBoolean,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true,
                                    'change'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'        => 8,
                            'width'                => 100,
                            'table'                => 'agents'),
						array(
                            'name'                => 'seller',
                            'description'        => 'Продавець',
                            'type'                => fldBoolean,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true,
                                    'change'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'        => 9,
                            'width'                => 100,
                            'table'                => 'agents'),
                        array(
                            'name'                => 'service',
                            'description'        => 'СТО',
                            'type'                => fldBoolean,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true,
                                    'change'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'        => 10,
                            'width'                => 100,
                            'table'                => 'agents'),
						 array(
                            'name'                => 'es_department',
                            'description'        => 'Штатний спiвробiтник',
                            'type'                => fldBoolean,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true,
                                    'change'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'        => 11,
                            'width'                => 100,
                            'table'                => 'accounts'),	
                        array(
                            'name'                => 'akt',
                            'description'        => 'Акт',
                            'type'                => fldBoolean,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true,
                                    'change'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'        => 12,
                            'width'                => 100,
                            'table'                => 'accounts'),
                        array(
                            'name'                => 'active',
                            'description'        => 'Активний',
                            'type'                => fldBoolean,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true,
                                    'change'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'        => 13,
                            'width'                => 100,
                            'table'                => 'accounts'),
						array(
						'name'                => 'allcomission',
						'description'        => 'Не применять 1/2',
						'type'                => fldBoolean,
						'display'            =>
							array(
								'show'        => true,
								'insert'    => true,
								'view'        => true,
								'update'    => true,
								'change'    => false
							),
						'verification'        =>
							array(
								'canBeEmpty'    => true
							),
						'orderPosition'        => 14,
						'width'                => 100,
						'table'                => 'agents'),
                        array(
                            'name'                => 'created',
                            'description'        => 'Створено',
                            'type'                => fldDate,
                            'value'                => 'NOW()',
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => false,
                                    'view'        => false,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        => 15,
                            'width'             => 100,
                            'table'                => 'accounts'),
						array(
							'name'				=> 'modified',
							'description'		=> 'Редаговано',
					        'type'				=> fldDate,
					        'value'				=> 'NOW()',
							'display'			=>
								array(
									'show'		=> false,
									'insert'	=> false,
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'accounts')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'    => 1,
                        'defaultOrderDirection'    => 'asc',
                        'titleField'            => 'login'
                    )
            );

    function Agents($data) {
        Form::Form($data);

        $this->messages['plural'] = 'Агенти';
        $this->messages['single'] = 'Агент';
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_AGENT:
                $this->permissions = array(
					'updateScreenResolutions'	=> true,
					'updateRecordsPerPage'		=> true,
					'updateProfile'				=> true,
                    'updatePassword'  			=> true);

                unset($this->formDescription['fields'][ $this->getFieldPositionByName('types_id') ]);
                unset($this->formDescription['fields'][ $this->getFieldPositionByName('akt') ]);
                break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				break;
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'      				=> true,
                    'insert'    				=> true,
                    'update'	    			=> true,
					'updateScreenResolutions'	=> true,
					'updateRecordsPerPage'		=> true,
					'updateProfile'				=> true,
                    'updatePassword'  			=> true,
                    'view'      				=> false,
                    'change'   					=> true,
                    'delete'    				=> true,
                    'export'    				=> true);
                break;
        }
    }

    function isLoginExists($field, $login, $id=null) {
        return parent::isLoginExists($field, $login, ROLES_AGENT, $id);
    }

	function setAdditionalFields($id, &$data) {
		global $db;

		$sql =	'SELECT agencies_id ' .
				'FROM ' . PREFIX . '_agents ' .
				'WHERE accounts_id = ' . intval($id);
		$agencies_id = $db->getOne($sql);
		$sql =	'SELECT synhronize ' .
				'FROM ' . PREFIX . '_agencies ' .
				'WHERE id = ' . intval($agencies_id);
		$data['synhronize'] = $db->getOne($sql);
		
		if (intval($data['service'])) {
			$sql  =	'UPDATE ' . PREFIX . '_agents SET ' .
					'service = 0 ' .
					'WHERE agencies_id = ' . intval($agencies_id) . ' AND accounts_id <> ' . intval($id);
			//$db->query($sql);
		}
	}

	function synhronize(&$data) {

		if (E_IX_SYNHRONIZATION != 1) return;

		$Client = new SoapClient(E_IX_URL . 'synchronization/express/index.php?wsdl');
		$type = 'agents';

		if (eregi ( 'change' , $data['do'] )) {
			$type='agentschange';
		}

		$result =	$Client->synhronize(
						array(
							'type'	=> $type,
							'data'		=> serialize($data)));
	}

	function change($data, $redirect = true) {
		global $db, $Log, $Authorization;

		$sql =	'SELECT synhronize ' .
				'FROM ' . PREFIX . '_agencies ' .
				'WHERE id = ' . intval($data['agencies_id']);
		$data['synhronize'] = $db->getOne($sql);

		parent::change($data,false);
		
		if ($data['synhronize']) {
			$this->synhronize($data);
		}
				
		if ($redirect) {
            $params['title'] = $this->messages['plural'];
            $params['storage'] = $this->tables[0];
            $Log->add('confirm', $this->messages['change']['confirm'], $params, '', true);
        }
        if ($redirect) {
            /*($data['redirect'])
                ? header('Location: ' . $data['redirect'])
                : header('Location: ' . $_SERVER['HTTP_REFERER']);
				*/
				header('Location: index.php?do=Agencies|view&id='.$data['agencies_id'].'');
            exit;
        }
	
	}

    function insert($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $db, $Log, $Authorization;

		$data['id'] = parent::insert(&$data, false, $showForm);

        if (intval($data['id'])) {

            $this->setAdditionalFields($data['id'], $data);
			
			if ($data['synhronize']) {
				$this->synhronize($data);
			}
				
			$params['title']    = $this->messages['single'];
			$params['id']       = $data['id'];
			$params['storage']  = $this->tables[0];

            if ($redirect) {
                $Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
                header('Location: ' . $data['redirect']);
                exit;
            } else {
                return $params['id'];
            }
		}
    }

    function load($data, $showForm=true, $action='update', $actionType='update', $template=null) {
        global $db;

        if (is_array($data['id'])) $data['id'] = $data['id'][0];

        $this->setTables('load');
        $this->getFormFields('update');

        $identityField = $this->getIdentityField();

        $sql =  'SELECT ' . implode(', ', $this->formFields) . ', ' . $this->tables[1] . '.*,  ' .
                'date_format(passport_date, \'%d\') as passport_date_day, date_format(passport_date, \'%m\') as passport_date_month, date_format(passport_date, \'%Y\') as passport_date_year, ' .
				'date_format(cart_date, \'%d\') as cart_date_day, date_format(cart_date, \'%m\') as cart_date_month, date_format(cart_date, \'%Y\') as cart_date_year, ' .
                'date_format(agreement_date, \'%d\') as agreement_date_day, date_format(agreement_date, \'%m\') as agreement_date_month, date_format(agreement_date, \'%Y\') as agreement_date_year, ' .
				'date_format(agreement_date_generali, \'%d\') as agreement_date_generali_day, date_format(agreement_date_generali, \'%m\') as agreement_date_generali_month, date_format(agreement_date_generali, \'%Y\') as agreement_date_generali_year ' .
                'FROM ' . $this->tables[0] . ' ' .
                'JOIN ' . $this->tables[1] . ' ON ' . $this->tables[0] . '.id = ' . $this->tables[1] . '.accounts_id ' .
                'WHERE ' . PREFIX . '_' . $identityField['table'] . '.' . $identityField['name'] . '=' . intval($data['id']);
        $data = $db->getRow($sql);

        $data = $this->prepareFields('update', $data);

        $this->showForm($data, $action, $actionType);
    }

    function update($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $db, $Log, $Authorization;

		$data['id'] = parent::update(&$data, false, $showForm);

        if (intval($data['id'])) {

            $this->setAdditionalFields($data['id'], $data);

			if ($data['synhronize']) {
				$this->synhronize($data);
			}
			$params['title']    = $this->messages['single'];
			$params['id']       = $data['id'];
			$params['storage']  = $this->tables[0];

            if ($redirect) {
                $Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
                header('Location: ' . $data['redirect']);
                exit;
            } else {
                return $params['id'];
            }
		}
    }

    function view($data, $conditions=null, $sql=null, $template=null, $showForm=true) {
        global $db;

        $this->checkPermissions('view', $data);
        $action		= 'view';
        $actionType = ($data['do'] == $this->object . '|previewInWindow') ? 'previewInWindow' : 'view';

        if (!$sql) {
            if (is_array($data['id'])) $data['id'] = $data['id'][0];

            $this->setTables('view');
            $this->getFormFields('view');

            $identityField = $this->getIdentityField();

            $prefix = ($conditions) ? implode(' AND ', $conditions) : '';

            $sql =	'SELECT ' . implode(', ', $this->formFields) . ', insurance_agents.* ' .
					'FROM ' . implode(', ', $this->tables) . ' ' .
					'WHERE ' . $this->getAssignmentConditions('view', $prefix, ' AND ') . PREFIX . '_' . $identityField['table'] . '.' . $identityField['name'] . '=' . intval($data['id']);
        }

        $data = $db->getRow($sql);
        $data = $this->prepareFields($action, $data);

        if ($showForm) {
            $this->showForm($data, $action, $actionType, $template);
        }

        return $data;
    }

    function deleteProcess($data, $i = 0, $folder=null) {
        global $db, $Log;

        $Policies = new Policies($data);

        $sql =  'SELECT id ' .
                'FROM ' . PREFIX . '_policies ' .
                'WHERE agents_id IN(' . implode(', ', $data['id']) . ')';
        $toDelete['id'] = $db->getCol($sql);

        if (sizeOf($toDelete['id'])) {
            $Log->add('error', 'Спочатку треба вилучити <b>' . $Policies->messages['plural'] . '</b>.');
            return false;
        }

        return parent::deleteProcess($data, $i, $folder);
    }

    function showDesktop($i = 1) {
        global $data, $Authorization;

        $data['do'] = 'Policies|show';

		if ($_SESSION['auth']['top_agencies_id'] == 245 || $_SESSION['auth']['top_agencies_id'] == 846) {//втб лайф
			$data['product_types_id'] = PRODUCT_TYPES_NS;
			$Policies = Policies::factory($data, 'NS');

			$Policies->objectTitle = 'Policies_NS';
			$Policies->show($data, $fields, $conditions, $sql);
		} elseif ($Authorization->data['agencies_id'] == AGENCY_SATIS) {
			$data['product_types_id'] = PRODUCT_TYPES_DMS;
			$Policies = Policies::factory($data, 'DMS');

			$Policies->objectTitle = 'Policies_DMS';
			$Policies->show($data, $fields, $conditions, $sql);
		} else {
			$data['product_types_id'] = PRODUCT_TYPES_KASKO;
			$Policies = Policies::factory($data, 'KASKO');

			$Policies->objectTitle = 'Policies_KASKO';
			$Policies->show($data, $fields, $conditions, $sql);
		}

        echo News::getRoll($data);
    }

    function exportInWindow($data) {
        global $db, $Smarty;

        $this->checkPermissions('export', $data);

        $conditions[] = '1';

        if (intval($data['agencies_id'])) {
            $conditions[] = 'agencies_id = ' . intval($data['agencies_id']);
        }

        $sql =  'SELECT a.*, b.*, c.code as agenciesCode, c.title as agencies_title ' .
                'FROM ' . PREFIX . '_accounts as a ' .
                'JOIN ' . PREFIX . '_agents as b ON a.id = b.accounts_id ' .
                'JOIN ' . PREFIX . '_agencies as c ON b.agencies_id = c.id ' .
                'WHERE ' . implode(' AND ', $conditions) . ' ' .
                'ORDER BY CAST(c.code AS UNSIGNED), a.lastname, a.firstname ';
        $list = $db->getAll($sql);
//_dump(sizeof($list));exit;
        $Smarty->assign('list', $list);

        $result = $Smarty->fetch($this->object . '/export.tpl');

        header('Content-Disposition: attachment; filename="agents.xls"');
        header('Content-Type: ' . $this->getContentType('agents.xls'));
        header('Content-Length: ' . strlen($result));

        echo $result;
        exit;
    }

    function getCommonByAgenciesId($agencies_id) {
        global $db;

        $conditions[] = 'roles_id = ' . ROLES_AGENT;
        $conditions[] = 'login = ' . $db->quote('ei' . $agencies_id);

        $sql =  'SELECT id ' .
                'FROM ' . PREFIX . '_accounts ' .
                'WHERE ' . implode(' AND ', $conditions);
        return $db->getOne($sql);
    }

    function setAktInWindow($data) {
        global $db;

        $sql =  'UPDATE ' . PREFIX . '_accounts SET ' .
                'akt = ' . intval($data['akt']) . ' ' .
                'WHERE id = ' . intval($data['accounts_id']);
        $db->query($sql);

        echo 'Ok';
        exit;
    }

    function downloadFileInWindow($data) {
        global $db, $MONTHES, $Smarty, $Authorization;
exit;
        if (!intval($data['id']) && !$data['aktnumber'] ||
            ($Authorization->data['roles_id'] == ROLES_AGENT && $data['id'] !=$Authorization->data['id'])) {
            //exit;
        }

        ereg('(.+)\.([0-9]{1,2})\.([0-9]{1,2})$', $data['aktnumber'], $regs);

        if (!$data['product_types_id']) $data['product_types_id'] = 1;

        $date['month']	= intval($regs[2]);
        $date['year']	= '20' . $regs[3];

        $file['name']	= $data['id'] . '_' . $date['month'] . '_' . $date['year'];
//$data['id']=4402;//вольска
        $sql =  'SELECT * ' .
                'FROM ' . PREFIX . '_agents AS a ' .
                'JOIN ' . PREFIX . '_accounts AS b ON a.accounts_id = b.id '.
                'WHERE a.accounts_id = ' . intval($data['id']);
        $row = $db->getRow($sql);

        $row['aktdate']        = $MONTHES[ $date['month'] - 1 ] . ' ' . $date['year'];
        $row['aktnumber']    = $data['aktnumber'];
		$row['firstday']	 = date('d.m.Y', mktime(0, 0, 0, $date['month'], 1, intval($date['year'])));
        $row['lastday']       = date('d.m.Y', mktime(0, 0, 0, $date['month'] + 1, 0, intval($date['year'])));
		
		$row['firstday_db']	 = date('Y-m-d', mktime(0, 0, 0, $date['month'], 1, intval($date['year'])));
        $row['lastday_db']       = date('Y-m-d 23:59:59', mktime(0, 0, 0, $date['month'] + 1, 0, intval($date['year'])));
	
		$row['firstday1']	 = date('Y-m-d', mktime(0, 0, 0, $date['month']+1, 1, intval($date['year'])));
		
		$row['direktor1']=intval($db->getOne('SELECT count(*) FROM '.PREFIX.'_policy_payments_calendar WHERE  direktor1_akt_number=' . $db->quote($data['aktnumber'])));
		$row['direktor2']=intval($db->getOne('SELECT count(*) FROM '.PREFIX.'_policy_payments_calendar WHERE  direktor2_akt_number=' . $db->quote($data['aktnumber'])));

		if ($row['akt']) {//нет задолжности

		    if ($row['direktor1']) {
				$conditions[] = 'k.direktor1_akt_number = ' . $db->quote($data['aktnumber']);
				$conditions[] = 'k.direktor_plan_date<>\'0000-00-00\'';
			} elseif ($row['direktor2']) {
				$conditions[] = 'k.direktor2_akt_number = ' . $db->quote($data['aktnumber']);
				$conditions[] = 'k.direktor_plan_date<>\'0000-00-00\'';
			} else {
				if ($data['car_service']) {
					$conditions[] = 'k.commission_service_amount > 0';
					$conditions[] = 'k.service_akt_number  = ' . $db->quote($data['aktnumber']);
				} else {
					$conditions[] = 'k.commission_agent_amount > 0';
					$conditions[] = 'k.agents_akt_number = ' . $db->quote($data['aktnumber']);
				}

				$conditions[] = 'a.documents  = 1';
				$conditions[] = 'k.statuses_id IN (' . PAYMENT_STATUSES_PAYED . ', ' . PAYMENT_STATUSES_OVER . ')';
			}	
        } else {//есть задолжность
            $conditions[] = 'a.product_types_id = ' . intval(PRODUCT_TYPES_KASKO);
            $conditions[] = 'a.documents = 0';
            $conditions[] = 'k.statuses_id IN (' . PAYMENT_STATUSES_PAYED . ', ' . PAYMENT_STATUSES_OVER . ')';

			if ($data['car_service']) {
				$conditions[] = 'k.commission_service_amount > 0';
				$conditions[] = '(k.payment_date_service  IS NULL OR k.payment_date_service = 0)';
			} else {
				$conditions[] = 'k.commission_agent_amount > 0';
				$conditions[] = '(k.payment_date_agent IS NULL OR k.payment_date_agent = 0)';
			}            

			$conditions[] = 'c.bankDatetime < DATE_ADD( NOW(), INTERVAL -30 DAY )';
            //$conditions[] = 'a.agents_id = ' . intval($data['id']);
        }

        //выбираем полиса
		$sql =  'SELECT a.product_types_id, a.date,a.number, a.insurance_companies_id,a.date,a.begin_datetime,a.end_datetime , a.item, a.amount, a.commission_agency_percent, a.commission_agent_percent, a.commission_financial_institution_percent,a.commission_service_percent , a.commission_director1_amount,a.commission_director1_percent,a.commission_director2_amount,a.commission_director2_percent,h.shassi, ' .
                'fin.title AS financial_institutions_title, ' .
                'IF(e1.id>0,e1.title,e.title) as agencies_title, IF(e1.id>0,e1.id,e.id) as agencies_id, ' .
                'CONCAT(f.lastname,\' \',f.firstname) as mangersFIO,e2.title as generaliTitle,e2.director1 as director1Generali, e2.director2 as director2Generali, e2.address as addressGenerali, e2.phones as phonesGenerali ,	e2.banking_details as banking_detailsGenerali,	e2.ground_akt as ground_aktGenerali, ' .
                'c.bankDatetime, a.solutions_id, k.direktor_plan_date, ' .
                'CASE a.product_types_id '.
                'WHEN ' . PRODUCT_TYPES_KASKO . ' THEN CONCAT(b.insurer_lastname, \' \', b.insurer_firstname, \' \', b.insurer_patronymicname) '.
                'WHEN ' . PRODUCT_TYPES_GO . ' THEN CONCAT(h.insurer_lastname, \' \', h.insurer_firstname, \' \', h.insurer_patronymicname) '.
				'WHEN ' . PRODUCT_TYPES_DGO . ' THEN CONCAT(h1.insurer_lastname, \' \', h1.insurer_firstname, \' \', h1.insurer_patronymicname) '.
                'ELSE \'\' '.
                'END as fio, ' .
				
                'k.amount AS payment_amount,k.payment_date, k.commission_agency_amount, k.commission_agent_amount,k.commission_service_amount, k.commission_director1_amount,k.commission_director2_amount,k.payment_date_director1,k.payment_date_director2, ' .
				'k.payment_date_agent, k.payment_date_agency, k.payment_date_financial_institution ' .
                'FROM ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policy_payments_calendar AS k ON a.id = k.policies_id ' .
                'LEFT JOIN ' . PREFIX . '_policies_kasko AS b ON a.id = b.policies_id ' .
                'LEFT JOIN ' . PREFIX . '_policies_go AS h ON a.id = h.policies_id ' .
				'LEFT JOIN ' . PREFIX . '_policies_dgo AS h1 ON a.id = h1.policies_id ' .
                'LEFT JOIN ' . PREFIX . '_financial_institutions AS fin ON b.financial_institutions_id = fin.id ' .
                'LEFT JOIN (' .
                'SELECT policies_id, MAX(datetime) AS bankDatetime ' .
                'FROM ' . PREFIX . '_policy_payments ' .
                'GROUP BY policies_id ' .
                ') as c ON a.id = c.policies_id ' .
                'JOIN ' . PREFIX . '_agencies AS e ON a.agencies_id = e.id ' .
				'LEFT JOIN ' . PREFIX . '_agencies AS e1 ON e1.id = e.parent_id ' .
                'JOIN ' . PREFIX . '_accounts AS f ON a.agents_id = f.id ' .
				'LEFT JOIN ' . PREFIX . '_generali_branches AS e2 ON e2.id = e.generali_branches_id ' .
                'WHERE ' . implode(' AND ', $conditions) . '  ' .
                'ORDER BY a.product_types_id,c.bankDatetime';
        $list = $row['policies'] = $db->getAll($sql);
		
		if (intval($data['id'])==327911) {//Дедяева
		//if (intval($data['id'])==4402) {//вольска
			$conditions=array();
			$conditions[] = 'k.direktor1_akt_number IN(\'5056.11.11\') ';
			//$conditions[] = 'k.direktor1_akt_number IN(\'4335.11.11\') ';//вольска

			$conditions[] = 'a.product_types_id =3';
			$sql =  'SELECT a.product_types_id, a.date,a.number, a.insurance_companies_id,a.date,a.begin_datetime,a.end_datetime , a.item, a.amount, a.commission_agency_percent, a.commission_director1_percent as commission_agent_percent, a.commission_financial_institution_percent, a.commission_service_percent , a.commission_director1_amount,a.commission_director1_percent,a.commission_director2_amount,a.commission_director2_percent,h.shassi, ' .
                'fin.title AS financial_institutions_title, ' .
                'IF(e1.id>0,e1.title,e.title) as agencies_title, IF(e1.id>0,e1.id,e.id) as agencies_id, ' .
                'CONCAT(f.lastname,\' \',f.firstname) as mangersFIO,e2.title as generaliTitle,e2.director1 as director1Generali, e2.director2 as director2Generali, e2.address as addressGenerali, e2.phones as phonesGenerali, e2.banking_details as banking_detailsGenerali, e2.ground_akt as ground_akt_generali, ' .
                'c.bankDatetime, a.solutions_id, k.direktor_plan_date, ' .
                'CASE a.product_types_id '.
                'WHEN ' . PRODUCT_TYPES_KASKO . ' THEN CONCAT(b.insurer_lastname, \' \', b.insurer_firstname, \' \', b.insurer_patronymicname) '.
                'WHEN ' . PRODUCT_TYPES_GO . ' THEN CONCAT(h.insurer_lastname, \' \', h.insurer_firstname, \' \', h.insurer_patronymicname) '.
				'WHEN ' . PRODUCT_TYPES_DGO . ' THEN CONCAT(h1.insurer_lastname, \' \', h1.insurer_firstname, \' \', h1.insurer_patronymicname) '.
                'ELSE \'\' '.
                'END as fio, ' .
				
				'CASE a.product_types_id '.
                'WHEN ' . PRODUCT_TYPES_KASKO . ' THEN b.service_person '.
                'WHEN ' . PRODUCT_TYPES_GO . ' THEN h.service_person '.
				'WHEN ' . PRODUCT_TYPES_DGO . ' THEN h1.service_person '.
                'ELSE \'\' '.
                'END as service_person, ' .
                'k.amount AS payment_amount,k.payment_date, k.commission_agency_amount, k.commission_director1_amount as commission_agent_amount,k.commission_service_amount, k.commission_director1_amount,k.commission_director2_amount,k.payment_date_director1,k.payment_date_director2, ' .
				'k.payment_date_agent, k.payment_date_agency, k.payment_date_financial_institution ' .
                'FROM ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policy_payments_calendar AS k ON a.id = k.policies_id ' .
                'LEFT JOIN ' . PREFIX . '_policies_kasko AS b ON a.id = b.policies_id ' .
                'LEFT JOIN ' . PREFIX . '_policies_go AS h ON a.id = h.policies_id ' .
				'LEFT JOIN ' . PREFIX . '_policies_dgo AS h1 ON a.id = h1.policies_id ' .
                'LEFT JOIN ' . PREFIX . '_financial_institutions AS fin ON b.financial_institutions_id = fin.id ' .
                'LEFT JOIN (' .
                'SELECT policies_id, MAX(datetime) AS bankDatetime ' .
                'FROM ' . PREFIX . '_policy_payments ' .
                'GROUP BY policies_id ' .
                ') as c ON a.id = c.policies_id ' .
                'JOIN ' . PREFIX . '_agencies AS e ON a.agencies_id = e.id ' .
				'LEFT JOIN ' . PREFIX . '_agencies AS e1 ON e1.id = e.parent_id ' .
                'JOIN ' . PREFIX . '_agents AS f ON a.agents_id = f.accounts_id ' .
				'LEFT JOIN ' . PREFIX . '_generali_branches AS e2 ON e2.id = e.generali_branches_id ' .
                'WHERE ' . implode(' AND ', $conditions) . '  ' .
                'ORDER BY a.product_types_id,c.bankDatetime';
				
				 $list1 =  $db->getAll($sql);
				 foreach ($list1 as $p) {
					 $list[]=$p;
					 $row['policies'][]=$p;
				 }
		}
//            _dump($sql);exit;
//            _dump($sql);exit;

        $row['payed'] = ($row['policies'][ 0 ]['payment_date_agent'] != '0000-00-00') ? true : false;
		$row['generali'] = false;
		$agencies_id= $row['policies'][ 0 ]['agencies_id'];
		if (!intval($agencies_id) && ($row['direktor1'] || $row['direktor2']))
		       $agencies_id=$db->getOne('SELECT agencies_id  FROM insurance_policies a JOIN insurance_policy_payments_calendar b on b.policies_id =a.id WHERE direktor1_akt_number=' . $db->quote($data['aktnumber']) .' OR direktor2_akt_number=' . $db->quote($data['aktnumber']) .' ');


		$sql =  'SELECT * ' .
                'FROM ' . PREFIX . '_agencies ' .
                'WHERE id = ' . intval($agencies_id);
        $row['agency'] = $db->getRow($sql);

		$row['agency']['aktnumber'] = $row['agency']['agreement_number'] . $date['month'] . '.' . $date['year'];

		 if (($row['direktor1'] || $row['direktor2']) && $agencies_id) {

		 	//сравнить план и факт
			$periods_id=$db->getOne('SELECT id FROM '.PREFIX.'_periods WHERE person_types_id =3 AND date ='.$db->quote($row['firstday1']));
			$plan=$db->getRow('SELECT credit_cars,not_credit_cars,go_cars FROM '.PREFIX.'_plans WHERE periods_id='.intval($periods_id).' AND agencies_id='.intval($agencies_id));

			//$plan['credit_cars'] = $plan['not_credit_cars']= $plan['go_cars']=0;

			//машины по каско факт БАНК
			$sql =	'SELECT IF(k2.id>0, k2.title, k1.title) AS agencyTitle, a.number, item, a.price, a.amount AS amount, a.insurer, CONCAT(ag.lastname , \' \', ag.firstname) AS fiomanager, ' .
					'b.financial_institutions_id, f.title AS financial_institutionstitle, c.datetime, a.solutions_id, a.bank_akt_payment_date, a.register_car_date ' .
					'FROM ' . PREFIX . '_policies AS a ' . 
					'JOIN ' . PREFIX . '_policies_kasko AS b ON a.id = b.policies_id ' . 
					'JOIN ' . PREFIX . '_agencies AS k1 ON a.agencies_id = k1.id ' .
					'LEFT JOIN ' . PREFIX . '_agencies AS k2 ON k1.parent_id = k2.id ' .
					'JOIN ' . PREFIX . '_accounts AS ag ON a.agents_id = ag.id ' . 
					'JOIN (SELECT policies_id, MIN(datetime) AS datetime FROM ' . PREFIX . '_policy_payments GROUP BY policies_id) AS c ON a.id = c.policies_id ' . 
					'LEFT JOIN ' . PREFIX . '_financial_institutions AS f ON b.financial_institutions_id = f.id ' .
					'WHERE a.solutions_id > 0  AND a.register_car_date BETWEEN ' . $db->quote($row['firstday_db']) . ' AND ' . $db->quote($row['lastday_db']) . ' ' .  
					'AND a.product_types_id = ' . PRODUCT_TYPES_KASKO . ' AND a.insurance_companies_id = ' . INSURANCE_COMPANIES_EXPRESS . ' AND IF(k2.id > 0, k2.id, k1.id) = ' . intval($agencies_id);
				$row['factkaskobank'] = $db->getAll($sql);	

			//машины по каско факт РИТЕЙЛ
			$sql =	'SELECT IF(k2.id>0, k2.title, k1.title) AS agencyTitle, a.number, item, a.price, a.amount AS amount, a.insurer, CONCAT(ag.lastname ,\' \',ag.firstname ) AS fiomanager, ' .
					'b.financial_institutions_id, f.title AS financial_institutionstitle, c.datetime, a.solutions_id, a.bank_akt_payment_date, a.register_car_date ' .  
					'FROM ' . PREFIX . '_policies AS a ' .
					'JOIN ' . PREFIX . '_policies_kasko AS b ON a.id = b.policies_id ' . 
					'JOIN ' . PREFIX . '_agencies AS k1 ON a.agencies_id = k1.id ' .
					'LEFT JOIN ' . PREFIX . '_agencies AS k2 ON k1.parent_id = k2.id ' .
					'JOIN ' . PREFIX . '_accounts AS ag ON a.agents_id = ag.id ' . 
					'JOIN ' . PREFIX . '_clients AS cl ON a.clients_id = cl.id ' . 
					'JOIN (SELECT policies_id, MIN(datetime) AS datetime FROM ' . PREFIX . '_policy_payments GROUP BY policies_id) AS c ON a.id = c.policies_id ' . 
					'LEFT JOIN ' . PREFIX . '_financial_institutions AS f ON b.financial_institutions_id = f.id ' .
					'WHERE c.datetime BETWEEN ' . $db->quote($row['firstday_db']) . ' AND ' . $db->quote($row['lastday_db']) . ' ' . 
					'AND a.solutions_id=0 AND a.documents = 1 AND cl.client_groups_id >= ' . CLIENT_GROUPS_OTHER . ' ' .
					'AND a.product_types_id = ' . PRODUCT_TYPES_KASKO . ' AND a.insurance_companies_id = ' . INSURANCE_COMPANIES_EXPRESS . ' AND IF(k2.id > 0, k2.id, k1.id) = ' . intval($agencies_id);
			$row['factkaskonotbank'] = $db->getAll($sql);	
//_dump($row['factkaskonotbank']);exit;
			$factCreditCars = sizeof($row['factkaskobank']);
			$factNotcredit_cars = sizeof($row['factkaskonotbank']);

			$plan['factCreditCars'] = $factCreditCars;
			$plan['factNotcredit_cars'] = $factNotcredit_cars;

			//машины по ГО факт
			$sql =	'SELECT IF(k2.id > 0, k2.title, k1.title) AS agencyTitle, a.number, item, a.price, a.amount AS amount, a.insurer, CONCAT(ag.lastname ,\' \',ag.firstname ) AS fiomanager, c.datetime ' . 
					'FROM ' . PREFIX . '_policies AS a ' . 
					'JOIN ' . PREFIX . '_policies_go AS b ON a.id = b.policies_id ' . 
					'JOIN ' . PREFIX . '_agencies AS k1 ON a.agencies_id = k1.id ' .
					'LEFT JOIN ' . PREFIX . '_agencies AS k2 ON k1.parent_id = k2.id ' .
					'JOIN ' . PREFIX . '_accounts AS ag ON a.agents_id = ag.id ' . 
					'JOIN (SELECT policies_id, MIN(datetime) AS datetime FROM ' . PREFIX . '_policy_payments GROUP BY policies_id) AS c ON a.id = c.policies_id ' . 
					'WHERE c.datetime BETWEEN ' . $db->quote($row['firstday_db']) . ' AND ' . $db->quote($row['lastday_db']) . ' AND a.product_types_id = ' . PRODUCT_TYPES_GO . ' AND IF(k2.id>0, k2.id, k1.id) = ' . intval($agencies_id);
			$row['factgo'] = $db->getAll($sql);

			$plan['factGoCars']=sizeOf($row['factgo']);
			//_dump($plan);exit;
		}
//_dump($plan);exit;
        if (is_array($row['policies']) && sizeof($row['policies'])>0 && ($row['policies'][0]['product_types_id'] == PRODUCT_TYPES_GO || $data['product_types_id'] == PRODUCT_TYPES_AUTO)) {

            $sum = 0;
			$gocount = 0;
            foreach ($row['policies'] as $policy) {
				if ($policy['product_types_id'] == PRODUCT_TYPES_KASKO && $policy['insurance_companies_id'] == INSURANCE_COMPANIES_GENERALI) {
					$row['generali'] =  true;
					$values['generali'] = $policy;
				}

				if ($policy['product_types_id']== PRODUCT_TYPES_GO) {
					if ($row['direktor1']) {
						$sum += $policy['commission_director1_amount'];
					} elseif ($row['direktor2']) {
						$sum += $policy['commission_director2_amount'];
					} else {
						$sum += $policy['commission_agent_amount'];
					}

					$gocount++;
				}
            }

            $sum = round(intval($sum)/10)*10;
            $policiescount = $sum/10;

            if ($gocount>0 && $gocount <= $policiescount) {

                $addpolicies = $policiescount - $gocount;

                $sql =  'SELECT CONCAT(lastname , \' \', firstname , \' \', patronymicname )as fio, cars_title, shassi ' .
                        'FROM ' . PREFIX . '_credit_clients AS a ' .
                        'JOIN ' . PREFIX . '_credit_client_cars AS b ON a.id = b.credit_clients_id ' .
                        'WHERE LENGTH(lastname) > 4 ' .
                        'ORDER BY RAND() ' .
                        'LIMIT ' . $addpolicies;
                $res = $db->query($sql);

                $additional = 1;
                while ($res->fetchInto($policy)) {
                    $row['policies'][] = array(
                        'fio'                   => $policy['fio'],
                        'item'                  => $policy['cars_title'],
                        'shassi'                => $policy['shassi'],
                        'commission_agent_amount' => 0,
						'commission_director1_amount' => 0,
						'commission_director2_amount' => 0,
						'product_types_id'		=> PRODUCT_TYPES_GO,
                        'additional'            => $additional);

                    $additional = 0;
                }
            }

            foreach ($row['policies'] as $i => $police) {
				if ($row['direktor1']) {
					$row['policies'][$i]['commission_agent_amount']	= $row['policies'][$i]['commission_director1_amount'];
					$row['policies'][$i]['commission_agent_percent']	= $row['policies'][$i]['commission_director1_percent'];
				} elseif ($row['direktor2']) {
					$row['policies'][$i]['commission_agent_amount']	= $row['policies'][$i]['commission_director2_amount'];
					$row['policies'][$i]['commission_agent_percent']	= $row['policies'][$i]['commission_director2_percent'];
				}

				if ($police['product_types_id']== PRODUCT_TYPES_GO) {
					$row['policies'][$i]['commission_agent_amount'] = ($sum>0) ? 10 : 0;
					$sum = $sum - 10;
				}
            }

			if ($row['direktor1'] || $row['direktor2']) {
				$template = 'aktDirektor.tpl';
			} elseif ($data['product_types_id']==1) {
				$template = 'aktAll' . ($row['generali'] ? 'Generali':'') . '.tpl';
			} else {
				$template = 'aktGO.tpl';
			}
        } else {
            $template = 'aktKASKO.tpl';
        }

		if ($row['direktor1'] || $row['direktor2'])
			$template = 'aktDirektor.tpl';
		$totals=array();
		if ($data['car_service']) {

			$totals1 = array();
			foreach ($list as $police) {
				$totals1[$police['service_person']] += $police['commission_service_amount'];
			}

			foreach ($totals1 as $key=>$val) {
				$totals[]=array('service_person'=>$key,'amount'=>$val);
			}
		}
//$row['aktnumber']	= $data['aktNumber'] = '5091.09.11';//вольска		
		$Smarty->assign('data', $data);
		$Smarty->assign('plan', $plan);

		$Smarty->assign('values', $values);
        $Smarty->assign('row', $row);
		$Smarty->assign('list', $list);
		$Smarty->assign('totals', $totals);
        $file['content'] = $Smarty->fetch($this->object . '/' . $template);

//echo $file['content'];exit;
        html2pdf($file);
        exit;
    }
	
	function getListInWindow($data) {
		global $db;
		
		$sql = 'SELECT a.id, CONCAT(a.lastname, \' \', a.firstname) as name ' .
			   'FROM ' . PREFIX . '_accounts as a ' .
			   'JOIN ' . PREFIX . '_agents as b ON a.id = b.accounts_id ' . 
			   'WHERE a.active = 1 AND agencies_id = ' . intval($data['agencies_id']) . ' ' .
			   'ORDER BY a.lastname, a.firstname';
			   
		echo json_encode($db->getAll($sql));
	}
}

?>
