<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                                   ATTENTION!
 * If you see this message in your browser (Internet Explorer, Mozilla Firefox, Google Chrome, etc.)
 * this means that PHP is not properly installed on your web server. Please refer to the PHP manual
 * for more details: http://php.net/manual/install.php 
 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */

    include_once dirname(__FILE__) . '/components/startup.php';
    include_once dirname(__FILE__) . '/components/application.php';
    include_once dirname(__FILE__) . '/' . 'authorization.php';


    include_once dirname(__FILE__) . '/' . 'database_engine/pgsql_engine.php';
    include_once dirname(__FILE__) . '/' . 'components/page/page_includes.php';

    function GetConnectionOptions()
    {
        $result = GetGlobalConnectionOptions();
        $result['client_encoding'] = 'utf8';
        GetApplication()->GetUserAuthentication()->applyIdentityToConnectionOptions($result);
        return $result;
    }

    
    
    
    // OnBeforePageExecute event handler
    
    
    
    class public_amenitiesticketsPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Amenitiestickets');
            $this->SetMenuLabel('Amenitiestickets');
    
            $this->dataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."amenitiestickets"');
            $this->dataset->addFields(
                array(
                    new IntegerField('amenityid', true, true),
                    new IntegerField('ticketid', true, true)
                )
            );
            $this->dataset->AddLookupField('amenityid', 'public.amenities', new IntegerField('id'), new StringField('service', false, false, false, false, 'LA1', 'LT1'), 'LT1');
            $this->dataset->AddLookupField('ticketid', 'public.tickets', new IntegerField('id'), new IntegerField('userid', false, false, false, false, 'LA2', 'LT2'), 'LT2');
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(20);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
        }
    
        protected function CreateRssGenerator()
        {
            return null;
        }
    
        protected function setupCharts()
        {
    
        }
    
        protected function getFiltersColumns()
        {
            return array(
                new FilterColumn($this->dataset, 'amenityid', 'LA1', 'Amenityid'),
                new FilterColumn($this->dataset, 'ticketid', 'LA2', 'Ticketid')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['amenityid'])
                ->addColumn($columns['ticketid']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('amenityid')
                ->setOptionsFor('ticketid');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new DynamicCombobox('amenityid_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_public_amenitiestickets_amenityid_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('amenityid', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_public_amenitiestickets_amenityid_search');
            
            $text_editor = new TextEdit('amenityid');
            
            $filterBuilder->addColumn(
                $columns['amenityid'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('ticketid_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_public_amenitiestickets_ticketid_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('ticketid', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_public_amenitiestickets_ticketid_search');
            
            $filterBuilder->addColumn(
                $columns['ticketid'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
    
        }
    
        protected function AddFieldColumns(Grid $grid, $withDetails = true)
        {
            //
            // View column for service field
            //
            $column = new TextViewColumn('amenityid', 'LA1', 'Amenityid', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for userid field
            //
            $column = new NumberViewColumn('ticketid', 'LA2', 'Ticketid', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for service field
            //
            $column = new TextViewColumn('amenityid', 'LA1', 'Amenityid', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for userid field
            //
            $column = new NumberViewColumn('ticketid', 'LA2', 'Ticketid', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for amenityid field
            //
            $editor = new DynamicCombobox('amenityid_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."amenities"');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true),
                    new StringField('service', true),
                    new IntegerField('price', true)
                )
            );
            $lookupDataset->setOrderByField('service', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Amenityid', 'amenityid', 'LA1', 'edit_public_amenitiestickets_amenityid_search', $editor, $this->dataset, $lookupDataset, 'id', 'service', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ticketid field
            //
            $editor = new DynamicCombobox('ticketid_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."tickets"');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true),
                    new IntegerField('userid', true),
                    new IntegerField('scheduleid', true),
                    new IntegerField('cabintypeid', true),
                    new StringField('firstname', true),
                    new StringField('lastname', true),
                    new StringField('phone', true),
                    new StringField('passportnumber', true),
                    new IntegerField('passportcountryid', true),
                    new StringField('bookingreference', true),
                    new BooleanField('confirmed', true)
                )
            );
            $lookupDataset->setOrderByField('userid', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Ticketid', 'ticketid', 'LA2', 'edit_public_amenitiestickets_ticketid_search', $editor, $this->dataset, $lookupDataset, 'id', 'userid', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for amenityid field
            //
            $editor = new DynamicCombobox('amenityid_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."amenities"');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true),
                    new StringField('service', true),
                    new IntegerField('price', true)
                )
            );
            $lookupDataset->setOrderByField('service', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Amenityid', 'amenityid', 'LA1', 'multi_edit_public_amenitiestickets_amenityid_search', $editor, $this->dataset, $lookupDataset, 'id', 'service', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ticketid field
            //
            $editor = new DynamicCombobox('ticketid_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."tickets"');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true),
                    new IntegerField('userid', true),
                    new IntegerField('scheduleid', true),
                    new IntegerField('cabintypeid', true),
                    new StringField('firstname', true),
                    new StringField('lastname', true),
                    new StringField('phone', true),
                    new StringField('passportnumber', true),
                    new IntegerField('passportcountryid', true),
                    new StringField('bookingreference', true),
                    new BooleanField('confirmed', true)
                )
            );
            $lookupDataset->setOrderByField('userid', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Ticketid', 'ticketid', 'LA2', 'multi_edit_public_amenitiestickets_ticketid_search', $editor, $this->dataset, $lookupDataset, 'id', 'userid', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddToggleEditColumns(Grid $grid)
        {
    
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for amenityid field
            //
            $editor = new DynamicCombobox('amenityid_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."amenities"');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true),
                    new StringField('service', true),
                    new IntegerField('price', true)
                )
            );
            $lookupDataset->setOrderByField('service', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Amenityid', 'amenityid', 'LA1', 'insert_public_amenitiestickets_amenityid_search', $editor, $this->dataset, $lookupDataset, 'id', 'service', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ticketid field
            //
            $editor = new DynamicCombobox('ticketid_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."tickets"');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true),
                    new IntegerField('userid', true),
                    new IntegerField('scheduleid', true),
                    new IntegerField('cabintypeid', true),
                    new StringField('firstname', true),
                    new StringField('lastname', true),
                    new StringField('phone', true),
                    new StringField('passportnumber', true),
                    new IntegerField('passportcountryid', true),
                    new StringField('bookingreference', true),
                    new BooleanField('confirmed', true)
                )
            );
            $lookupDataset->setOrderByField('userid', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Ticketid', 'ticketid', 'LA2', 'insert_public_amenitiestickets_ticketid_search', $editor, $this->dataset, $lookupDataset, 'id', 'userid', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            $grid->SetShowAddButton(false && $this->GetSecurityInfo()->HasAddGrant());
        }
    
        private function AddMultiUploadColumn(Grid $grid)
        {
    
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for service field
            //
            $column = new TextViewColumn('amenityid', 'LA1', 'Amenityid', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for userid field
            //
            $column = new NumberViewColumn('ticketid', 'LA2', 'Ticketid', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for service field
            //
            $column = new TextViewColumn('amenityid', 'LA1', 'Amenityid', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for userid field
            //
            $column = new NumberViewColumn('ticketid', 'LA2', 'Ticketid', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for service field
            //
            $column = new TextViewColumn('amenityid', 'LA1', 'Amenityid', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for userid field
            //
            $column = new NumberViewColumn('ticketid', 'LA2', 'Ticketid', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
        }
    
        private function AddCompareHeaderColumns(Grid $grid)
        {
    
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        public function isFilterConditionRequired()
        {
            return false;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
    		$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset);
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(false);
            else
               $result->SetAllowDeleteSelected(false);   
            
            ApplyCommonPageSettings($this, $result);
            
            $result->SetUseImagesForActions(true);
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(true);
            $result->setAllowCompare(true);
            $this->AddCompareHeaderColumns($result);
            $this->AddCompareColumns($result);
            $result->setMultiEditAllowed($this->GetSecurityInfo()->HasEditGrant() && false);
            $result->setTableBordered(false);
            $result->setTableCondensed(false);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddMultiEditColumns($result);
            $this->AddToggleEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
            $this->AddMultiUploadColumn($result);
    
    
            $this->SetShowPageList(true);
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(true);
            $this->setAllowedActions(array());
            $this->setPrintListAvailable(true);
            $this->setPrintListRecordAvailable(false);
            $this->setPrintOneRecordAvailable(true);
            $this->setAllowPrintSelectedRecords(true);
            $this->setExportListAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportSelectedRecordsAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportListRecordAvailable(array());
            $this->setExportOneRecordAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
    
            return $result;
        }
     
        protected function setClientSideEvents(Grid $grid) {
    
        }
    
        protected function doRegisterHandlers() {
            $lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."amenities"');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true),
                    new StringField('service', true),
                    new IntegerField('price', true)
                )
            );
            $lookupDataset->setOrderByField('service', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_public_amenitiestickets_amenityid_search', 'id', 'service', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."tickets"');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true),
                    new IntegerField('userid', true),
                    new IntegerField('scheduleid', true),
                    new IntegerField('cabintypeid', true),
                    new StringField('firstname', true),
                    new StringField('lastname', true),
                    new StringField('phone', true),
                    new StringField('passportnumber', true),
                    new IntegerField('passportcountryid', true),
                    new StringField('bookingreference', true),
                    new BooleanField('confirmed', true)
                )
            );
            $lookupDataset->setOrderByField('userid', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_public_amenitiestickets_ticketid_search', 'id', 'userid', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."amenities"');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true),
                    new StringField('service', true),
                    new IntegerField('price', true)
                )
            );
            $lookupDataset->setOrderByField('service', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_public_amenitiestickets_amenityid_search', 'id', 'service', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."tickets"');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true),
                    new IntegerField('userid', true),
                    new IntegerField('scheduleid', true),
                    new IntegerField('cabintypeid', true),
                    new StringField('firstname', true),
                    new StringField('lastname', true),
                    new StringField('phone', true),
                    new StringField('passportnumber', true),
                    new IntegerField('passportcountryid', true),
                    new StringField('bookingreference', true),
                    new BooleanField('confirmed', true)
                )
            );
            $lookupDataset->setOrderByField('userid', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_public_amenitiestickets_ticketid_search', 'id', 'userid', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."amenities"');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true),
                    new StringField('service', true),
                    new IntegerField('price', true)
                )
            );
            $lookupDataset->setOrderByField('service', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_public_amenitiestickets_amenityid_search', 'id', 'service', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."tickets"');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true),
                    new IntegerField('userid', true),
                    new IntegerField('scheduleid', true),
                    new IntegerField('cabintypeid', true),
                    new StringField('firstname', true),
                    new StringField('lastname', true),
                    new StringField('phone', true),
                    new StringField('passportnumber', true),
                    new IntegerField('passportcountryid', true),
                    new StringField('bookingreference', true),
                    new BooleanField('confirmed', true)
                )
            );
            $lookupDataset->setOrderByField('userid', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_public_amenitiestickets_ticketid_search', 'id', 'userid', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."amenities"');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true),
                    new StringField('service', true),
                    new IntegerField('price', true)
                )
            );
            $lookupDataset->setOrderByField('service', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_public_amenitiestickets_amenityid_search', 'id', 'service', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."tickets"');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true),
                    new IntegerField('userid', true),
                    new IntegerField('scheduleid', true),
                    new IntegerField('cabintypeid', true),
                    new StringField('firstname', true),
                    new StringField('lastname', true),
                    new StringField('phone', true),
                    new StringField('passportnumber', true),
                    new IntegerField('passportcountryid', true),
                    new StringField('bookingreference', true),
                    new BooleanField('confirmed', true)
                )
            );
            $lookupDataset->setOrderByField('userid', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_public_amenitiestickets_ticketid_search', 'id', 'userid', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
        }
       
        protected function doCustomRenderColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderPrintColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderExportColumn($exportType, $fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomDrawRow($rowData, &$cellFontColor, &$cellFontSize, &$cellBgColor, &$cellItalicAttr, &$cellBoldAttr)
        {
    
        }
    
        protected function doExtendedCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles, &$rowClasses, &$cellClasses)
        {
    
        }
    
        protected function doCustomRenderTotal($totalValue, $aggregate, $columnName, &$customText, &$handled)
        {
    
        }
    
        protected function doCustomDefaultValues(&$values, &$handled) 
        {
    
        }
    
        protected function doCustomCompareColumn($columnName, $valueA, $valueB, &$result)
        {
    
        }
    
        protected function doBeforeInsertRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeUpdateRecord($page, $oldRowData, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeDeleteRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterInsertRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterUpdateRecord($page, $oldRowData, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterDeleteRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doCustomHTMLHeader($page, &$customHtmlHeaderText)
        { 
    
        }
    
        protected function doGetCustomTemplate($type, $part, $mode, &$result, &$params)
        {
    
        }
    
        protected function doGetCustomExportOptions(Page $page, $exportType, $rowData, &$options)
        {
    
        }
    
        protected function doFileUpload($fieldName, $rowData, &$result, &$accept, $originalFileName, $originalFileExtension, $fileSize, $tempFileName)
        {
    
        }
    
        protected function doPrepareChart(Chart $chart)
        {
    
        }
    
        protected function doPrepareColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function doPrepareFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
    
        }
    
        protected function doGetSelectionFilters(FixedKeysArray $columns, &$result)
        {
    
        }
    
        protected function doGetCustomFormLayout($mode, FixedKeysArray $columns, FormLayout $layout)
        {
    
        }
    
        protected function doGetCustomColumnGroup(FixedKeysArray $columns, ViewColumnGroup $columnGroup)
        {
    
        }
    
        protected function doPageLoaded()
        {
    
        }
    
        protected function doCalculateFields($rowData, $fieldName, &$value)
        {
    
        }
    
        protected function doGetCustomRecordPermissions(Page $page, &$usingCondition, $rowData, &$allowEdit, &$allowDelete, &$mergeWithDefault, &$handled)
        {
    
        }
    
        protected function doAddEnvironmentVariables(Page $page, &$variables)
        {
    
        }
    
    }

    SetUpUserAuthorization();

    try
    {
        $Page = new public_amenitiesticketsPage("public_amenitiestickets", "amenitiestickets.php", GetCurrentUserPermissionsForPage("public.amenitiestickets"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("public.amenitiestickets"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
