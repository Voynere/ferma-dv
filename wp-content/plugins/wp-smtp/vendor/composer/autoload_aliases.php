<?php

// Functions and constants

namespace {

}


namespace SolidWP\Mail {

    use BrianHenryIE\Strauss\Types\AutoloadAliasInterface;

    /**
     * @see AutoloadAliasInterface
     *
     * @phpstan-type ClassAliasArray array{'type':'class',isabstract:bool,classname:string,namespace?:string,extends:string,implements:array<string>}
     * @phpstan-type InterfaceAliasArray array{'type':'interface',interfacename:string,namespace?:string,extends:array<string>}
     * @phpstan-type TraitAliasArray array{'type':'trait',traitname:string,namespace?:string,use:array<string>}
     * @phpstan-type AutoloadAliasArray array<string,ClassAliasArray|InterfaceAliasArray|TraitAliasArray>
     */
    class AliasAutoloader
    {
        private string $includeFilePath;

        /**
         * @var AutoloadAliasArray
         */
        private array $autoloadAliases = array (
  'lucatume\\DI52\\App' => 
  array (
    'type' => 'class',
    'classname' => 'App',
    'isabstract' => false,
    'namespace' => 'lucatume\\DI52',
    'extends' => 'SolidWP\\Mail\\lucatume\\DI52\\App',
    'implements' => 
    array (
    ),
  ),
  'lucatume\\DI52\\Builders\\CallableBuilder' => 
  array (
    'type' => 'class',
    'classname' => 'CallableBuilder',
    'isabstract' => false,
    'namespace' => 'lucatume\\DI52\\Builders',
    'extends' => 'SolidWP\\Mail\\lucatume\\DI52\\Builders\\CallableBuilder',
    'implements' => 
    array (
      0 => 'lucatume\\DI52\\Builders\\BuilderInterface',
      1 => 'lucatume\\DI52\\Builders\\ReinitializableBuilderInterface',
    ),
  ),
  'lucatume\\DI52\\Builders\\ClassBuilder' => 
  array (
    'type' => 'class',
    'classname' => 'ClassBuilder',
    'isabstract' => false,
    'namespace' => 'lucatume\\DI52\\Builders',
    'extends' => 'SolidWP\\Mail\\lucatume\\DI52\\Builders\\ClassBuilder',
    'implements' => 
    array (
      0 => 'lucatume\\DI52\\Builders\\BuilderInterface',
      1 => 'lucatume\\DI52\\Builders\\ReinitializableBuilderInterface',
    ),
  ),
  'lucatume\\DI52\\Builders\\ClosureBuilder' => 
  array (
    'type' => 'class',
    'classname' => 'ClosureBuilder',
    'isabstract' => false,
    'namespace' => 'lucatume\\DI52\\Builders',
    'extends' => 'SolidWP\\Mail\\lucatume\\DI52\\Builders\\ClosureBuilder',
    'implements' => 
    array (
      0 => 'lucatume\\DI52\\Builders\\BuilderInterface',
    ),
  ),
  'lucatume\\DI52\\Builders\\Factory' => 
  array (
    'type' => 'class',
    'classname' => 'Factory',
    'isabstract' => false,
    'namespace' => 'lucatume\\DI52\\Builders',
    'extends' => 'SolidWP\\Mail\\lucatume\\DI52\\Builders\\Factory',
    'implements' => 
    array (
    ),
  ),
  'lucatume\\DI52\\Builders\\Parameter' => 
  array (
    'type' => 'class',
    'classname' => 'Parameter',
    'isabstract' => false,
    'namespace' => 'lucatume\\DI52\\Builders',
    'extends' => 'SolidWP\\Mail\\lucatume\\DI52\\Builders\\Parameter',
    'implements' => 
    array (
    ),
  ),
  'lucatume\\DI52\\Builders\\Resolver' => 
  array (
    'type' => 'class',
    'classname' => 'Resolver',
    'isabstract' => false,
    'namespace' => 'lucatume\\DI52\\Builders',
    'extends' => 'SolidWP\\Mail\\lucatume\\DI52\\Builders\\Resolver',
    'implements' => 
    array (
    ),
  ),
  'lucatume\\DI52\\Builders\\ValueBuilder' => 
  array (
    'type' => 'class',
    'classname' => 'ValueBuilder',
    'isabstract' => false,
    'namespace' => 'lucatume\\DI52\\Builders',
    'extends' => 'SolidWP\\Mail\\lucatume\\DI52\\Builders\\ValueBuilder',
    'implements' => 
    array (
      0 => 'lucatume\\DI52\\Builders\\BuilderInterface',
    ),
  ),
  'lucatume\\DI52\\Container' => 
  array (
    'type' => 'class',
    'classname' => 'Container',
    'isabstract' => false,
    'namespace' => 'lucatume\\DI52',
    'extends' => 'SolidWP\\Mail\\lucatume\\DI52\\Container',
    'implements' => 
    array (
      0 => 'ArrayAccess',
      1 => 'Psr\\Container\\ContainerInterface',
    ),
  ),
  'lucatume\\DI52\\ContainerException' => 
  array (
    'type' => 'class',
    'classname' => 'ContainerException',
    'isabstract' => false,
    'namespace' => 'lucatume\\DI52',
    'extends' => 'SolidWP\\Mail\\lucatume\\DI52\\ContainerException',
    'implements' => 
    array (
      0 => 'Psr\\Container\\ContainerExceptionInterface',
    ),
  ),
  'lucatume\\DI52\\NestedParseError' => 
  array (
    'type' => 'class',
    'classname' => 'NestedParseError',
    'isabstract' => false,
    'namespace' => 'lucatume\\DI52',
    'extends' => 'SolidWP\\Mail\\lucatume\\DI52\\NestedParseError',
    'implements' => 
    array (
    ),
  ),
  'lucatume\\DI52\\NotFoundException' => 
  array (
    'type' => 'class',
    'classname' => 'NotFoundException',
    'isabstract' => false,
    'namespace' => 'lucatume\\DI52',
    'extends' => 'SolidWP\\Mail\\lucatume\\DI52\\NotFoundException',
    'implements' => 
    array (
      0 => 'Psr\\Container\\NotFoundExceptionInterface',
    ),
  ),
  'lucatume\\DI52\\ServiceProvider' => 
  array (
    'type' => 'class',
    'classname' => 'ServiceProvider',
    'isabstract' => true,
    'namespace' => 'lucatume\\DI52',
    'extends' => 'SolidWP\\Mail\\lucatume\\DI52\\ServiceProvider',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Arrays\\Arr' => 
  array (
    'type' => 'class',
    'classname' => 'Arr',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Arrays',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Arrays\\Arr',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Assets\\Asset' => 
  array (
    'type' => 'class',
    'classname' => 'Asset',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Assets',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Assets\\Asset',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Assets\\Assets' => 
  array (
    'type' => 'class',
    'classname' => 'Assets',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Assets',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Assets\\Assets',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Assets\\Config' => 
  array (
    'type' => 'class',
    'classname' => 'Config',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Assets',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Assets\\Config',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Assets\\Controller' => 
  array (
    'type' => 'class',
    'classname' => 'Controller',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Assets',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Assets\\Controller',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Assets\\Data' => 
  array (
    'type' => 'class',
    'classname' => 'Data',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Assets',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Assets\\Data',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Assets\\Utils' => 
  array (
    'type' => 'class',
    'classname' => 'Utils',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Assets',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Assets\\Utils',
    'implements' => 
    array (
    ),
  ),
  'Your\\Namespace\\Container' => 
  array (
    'type' => 'class',
    'classname' => 'Container',
    'isabstract' => false,
    'namespace' => 'Your\\Namespace',
    'extends' => 'SolidWP\\Mail\\Your\\Namespace\\Container',
    'implements' => 
    array (
      0 => 'StellarWP\\ContainerContract\\ContainerInterface',
    ),
  ),
  'StellarWP\\FieldConditions\\ComplexConditionSet' => 
  array (
    'type' => 'class',
    'classname' => 'ComplexConditionSet',
    'isabstract' => false,
    'namespace' => 'StellarWP\\FieldConditions',
    'extends' => 'SolidWP\\Mail\\StellarWP\\FieldConditions\\ComplexConditionSet',
    'implements' => 
    array (
      0 => 'StellarWP\\FieldConditions\\Contracts\\ConditionSet',
    ),
  ),
  'StellarWP\\FieldConditions\\Config' => 
  array (
    'type' => 'class',
    'classname' => 'Config',
    'isabstract' => false,
    'namespace' => 'StellarWP\\FieldConditions',
    'extends' => 'SolidWP\\Mail\\StellarWP\\FieldConditions\\Config',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\FieldConditions\\FieldCondition' => 
  array (
    'type' => 'class',
    'classname' => 'FieldCondition',
    'isabstract' => false,
    'namespace' => 'StellarWP\\FieldConditions',
    'extends' => 'SolidWP\\Mail\\StellarWP\\FieldConditions\\FieldCondition',
    'implements' => 
    array (
      0 => 'StellarWP\\FieldConditions\\Contracts\\Condition',
    ),
  ),
  'StellarWP\\FieldConditions\\NestedCondition' => 
  array (
    'type' => 'class',
    'classname' => 'NestedCondition',
    'isabstract' => false,
    'namespace' => 'StellarWP\\FieldConditions',
    'extends' => 'SolidWP\\Mail\\StellarWP\\FieldConditions\\NestedCondition',
    'implements' => 
    array (
      0 => 'StellarWP\\FieldConditions\\Contracts\\Condition',
      1 => 'StellarWP\\FieldConditions\\Contracts\\ConditionSet',
    ),
  ),
  'StellarWP\\FieldConditions\\SimpleConditionSet' => 
  array (
    'type' => 'class',
    'classname' => 'SimpleConditionSet',
    'isabstract' => false,
    'namespace' => 'StellarWP\\FieldConditions',
    'extends' => 'SolidWP\\Mail\\StellarWP\\FieldConditions\\SimpleConditionSet',
    'implements' => 
    array (
      0 => 'StellarWP\\FieldConditions\\Contracts\\ConditionSet',
    ),
  ),
  'StellarWP\\FieldConditions\\Tests\\TestCase' => 
  array (
    'type' => 'class',
    'classname' => 'TestCase',
    'isabstract' => false,
    'namespace' => 'StellarWP\\FieldConditions\\Tests',
    'extends' => 'SolidWP\\Mail\\StellarWP\\FieldConditions\\Tests\\TestCase',
    'implements' => 
    array (
    ),
  ),
  'unit\\ComplexConditionSetTest' => 
  array (
    'type' => 'class',
    'classname' => 'ComplexConditionSetTest',
    'isabstract' => false,
    'namespace' => 'unit',
    'extends' => 'SolidWP\\Mail\\unit\\ComplexConditionSetTest',
    'implements' => 
    array (
    ),
  ),
  'unit\\Concerns\\HasConditionsTest' => 
  array (
    'type' => 'class',
    'classname' => 'HasConditionsTest',
    'isabstract' => false,
    'namespace' => 'unit\\Concerns',
    'extends' => 'SolidWP\\Mail\\unit\\Concerns\\HasConditionsTest',
    'implements' => 
    array (
    ),
  ),
  'unit\\Concerns\\ConditionSet' => 
  array (
    'type' => 'class',
    'classname' => 'ConditionSet',
    'isabstract' => false,
    'namespace' => 'unit\\Concerns',
    'extends' => 'SolidWP\\Mail\\unit\\Concerns\\ConditionSet',
    'implements' => 
    array (
      0 => 'StellarWP\\FieldConditions\\Contracts\\ConditionSet',
    ),
  ),
  'unit\\Concerns\\ConditionSetWithDifferentBaseClass' => 
  array (
    'type' => 'class',
    'classname' => 'ConditionSetWithDifferentBaseClass',
    'isabstract' => false,
    'namespace' => 'unit\\Concerns',
    'extends' => 'SolidWP\\Mail\\unit\\Concerns\\ConditionSetWithDifferentBaseClass',
    'implements' => 
    array (
      0 => 'StellarWP\\FieldConditions\\Contracts\\ConditionSet',
    ),
  ),
  'unit\\Concerns\\MockCondition' => 
  array (
    'type' => 'class',
    'classname' => 'MockCondition',
    'isabstract' => false,
    'namespace' => 'unit\\Concerns',
    'extends' => 'SolidWP\\Mail\\unit\\Concerns\\MockCondition',
    'implements' => 
    array (
      0 => 'StellarWP\\FieldConditions\\Contracts\\Condition',
    ),
  ),
  'unit\\Concerns\\HasLogicalOperatorTest' => 
  array (
    'type' => 'class',
    'classname' => 'HasLogicalOperatorTest',
    'isabstract' => false,
    'namespace' => 'unit\\Concerns',
    'extends' => 'SolidWP\\Mail\\unit\\Concerns\\HasLogicalOperatorTest',
    'implements' => 
    array (
    ),
  ),
  'unit\\Concerns\\LogicalClass' => 
  array (
    'type' => 'class',
    'classname' => 'LogicalClass',
    'isabstract' => false,
    'namespace' => 'unit\\Concerns',
    'extends' => 'SolidWP\\Mail\\unit\\Concerns\\LogicalClass',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\SuperGlobals\\SuperGlobals' => 
  array (
    'type' => 'class',
    'classname' => 'SuperGlobals',
    'isabstract' => false,
    'namespace' => 'StellarWP\\SuperGlobals',
    'extends' => 'SolidWP\\Mail\\StellarWP\\SuperGlobals\\SuperGlobals',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Telemetry\\Admin\\Admin_Subscriber' => 
  array (
    'type' => 'class',
    'classname' => 'Admin_Subscriber',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Telemetry\\Admin',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Telemetry\\Admin\\Admin_Subscriber',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Telemetry\\Admin\\Resources' => 
  array (
    'type' => 'class',
    'classname' => 'Resources',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Telemetry\\Admin',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Telemetry\\Admin\\Resources',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Telemetry\\Config' => 
  array (
    'type' => 'class',
    'classname' => 'Config',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Telemetry',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Telemetry\\Config',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Telemetry\\Contracts\\Abstract_Subscriber' => 
  array (
    'type' => 'class',
    'classname' => 'Abstract_Subscriber',
    'isabstract' => true,
    'namespace' => 'StellarWP\\Telemetry\\Contracts',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Telemetry\\Contracts\\Abstract_Subscriber',
    'implements' => 
    array (
      0 => 'StellarWP\\Telemetry\\Contracts\\Subscriber_Interface',
    ),
  ),
  'StellarWP\\Telemetry\\Core' => 
  array (
    'type' => 'class',
    'classname' => 'Core',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Telemetry',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Telemetry\\Core',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Telemetry\\Data_Providers\\Debug_Data' => 
  array (
    'type' => 'class',
    'classname' => 'Debug_Data',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Telemetry\\Data_Providers',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Telemetry\\Data_Providers\\Debug_Data',
    'implements' => 
    array (
      0 => 'StellarWP\\Telemetry\\Contracts\\Data_Provider',
    ),
  ),
  'StellarWP\\Telemetry\\Data_Providers\\Null_Data_Provider' => 
  array (
    'type' => 'class',
    'classname' => 'Null_Data_Provider',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Telemetry\\Data_Providers',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Telemetry\\Data_Providers\\Null_Data_Provider',
    'implements' => 
    array (
      0 => 'StellarWP\\Telemetry\\Contracts\\Data_Provider',
    ),
  ),
  'StellarWP\\Telemetry\\Events\\Event' => 
  array (
    'type' => 'class',
    'classname' => 'Event',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Telemetry\\Events',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Telemetry\\Events\\Event',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Telemetry\\Events\\Event_Subscriber' => 
  array (
    'type' => 'class',
    'classname' => 'Event_Subscriber',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Telemetry\\Events',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Telemetry\\Events\\Event_Subscriber',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Telemetry\\Exit_Interview\\Exit_Interview_Subscriber' => 
  array (
    'type' => 'class',
    'classname' => 'Exit_Interview_Subscriber',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Telemetry\\Exit_Interview',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Telemetry\\Exit_Interview\\Exit_Interview_Subscriber',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Telemetry\\Exit_Interview\\Template' => 
  array (
    'type' => 'class',
    'classname' => 'Template',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Telemetry\\Exit_Interview',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Telemetry\\Exit_Interview\\Template',
    'implements' => 
    array (
      0 => 'StellarWP\\Telemetry\\Contracts\\Template_Interface',
    ),
  ),
  'StellarWP\\Telemetry\\Last_Send\\Last_Send' => 
  array (
    'type' => 'class',
    'classname' => 'Last_Send',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Telemetry\\Last_Send',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Telemetry\\Last_Send\\Last_Send',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Telemetry\\Last_Send\\Last_Send_Subscriber' => 
  array (
    'type' => 'class',
    'classname' => 'Last_Send_Subscriber',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Telemetry\\Last_Send',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Telemetry\\Last_Send\\Last_Send_Subscriber',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Telemetry\\Opt_In\\Opt_In_Subscriber' => 
  array (
    'type' => 'class',
    'classname' => 'Opt_In_Subscriber',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Telemetry\\Opt_In',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Telemetry\\Opt_In\\Opt_In_Subscriber',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Telemetry\\Opt_In\\Opt_In_Template' => 
  array (
    'type' => 'class',
    'classname' => 'Opt_In_Template',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Telemetry\\Opt_In',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Telemetry\\Opt_In\\Opt_In_Template',
    'implements' => 
    array (
      0 => 'StellarWP\\Telemetry\\Contracts\\Template_Interface',
    ),
  ),
  'StellarWP\\Telemetry\\Opt_In\\Status' => 
  array (
    'type' => 'class',
    'classname' => 'Status',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Telemetry\\Opt_In',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Telemetry\\Opt_In\\Status',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Telemetry\\Telemetry\\Telemetry' => 
  array (
    'type' => 'class',
    'classname' => 'Telemetry',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Telemetry\\Telemetry',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Telemetry\\Telemetry\\Telemetry',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Telemetry\\Telemetry\\Telemetry_Subscriber' => 
  array (
    'type' => 'class',
    'classname' => 'Telemetry_Subscriber',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Telemetry\\Telemetry',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Telemetry\\Telemetry\\Telemetry_Subscriber',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Telemetry\\Uninstall' => 
  array (
    'type' => 'class',
    'classname' => 'Uninstall',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Telemetry',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Telemetry\\Uninstall',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Validation\\Commands\\ExcludeValue' => 
  array (
    'type' => 'class',
    'classname' => 'ExcludeValue',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Commands',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Commands\\ExcludeValue',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Validation\\Commands\\SkipValidationRules' => 
  array (
    'type' => 'class',
    'classname' => 'SkipValidationRules',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Commands',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Commands\\SkipValidationRules',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Validation\\Config' => 
  array (
    'type' => 'class',
    'classname' => 'Config',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Config',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Validation\\Exceptions\\ValidationException' => 
  array (
    'type' => 'class',
    'classname' => 'ValidationException',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Exceptions',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Exceptions\\ValidationException',
    'implements' => 
    array (
      0 => 'StellarWP\\Validation\\Exceptions\\Contracts\\ValidationExceptionInterface',
    ),
  ),
  'StellarWP\\Validation\\Rules\\Abstracts\\ConditionalRule' => 
  array (
    'type' => 'class',
    'classname' => 'ConditionalRule',
    'isabstract' => true,
    'namespace' => 'StellarWP\\Validation\\Rules\\Abstracts',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Rules\\Abstracts\\ConditionalRule',
    'implements' => 
    array (
      0 => 'StellarWP\\Validation\\Contracts\\ValidationRule',
      1 => 'StellarWP\\Validation\\Contracts\\ValidatesOnFrontEnd',
    ),
  ),
  'StellarWP\\Validation\\Rules\\Boolean' => 
  array (
    'type' => 'class',
    'classname' => 'Boolean',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Rules',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Rules\\Boolean',
    'implements' => 
    array (
      0 => 'StellarWP\\Validation\\Contracts\\ValidationRule',
      1 => 'StellarWP\\Validation\\Contracts\\ValidatesOnFrontEnd',
      2 => 'StellarWP\\Validation\\Contracts\\Sanitizer',
    ),
  ),
  'StellarWP\\Validation\\Rules\\Currency' => 
  array (
    'type' => 'class',
    'classname' => 'Currency',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Rules',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Rules\\Currency',
    'implements' => 
    array (
      0 => 'StellarWP\\Validation\\Contracts\\ValidationRule',
      1 => 'StellarWP\\Validation\\Contracts\\ValidatesOnFrontEnd',
    ),
  ),
  'StellarWP\\Validation\\Rules\\DateTime' => 
  array (
    'type' => 'class',
    'classname' => 'DateTime',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Rules',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Rules\\DateTime',
    'implements' => 
    array (
      0 => 'StellarWP\\Validation\\Contracts\\ValidationRule',
      1 => 'StellarWP\\Validation\\Contracts\\ValidatesOnFrontEnd',
      2 => 'StellarWP\\Validation\\Contracts\\Sanitizer',
    ),
  ),
  'StellarWP\\Validation\\Rules\\Email' => 
  array (
    'type' => 'class',
    'classname' => 'Email',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Rules',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Rules\\Email',
    'implements' => 
    array (
      0 => 'StellarWP\\Validation\\Contracts\\ValidationRule',
      1 => 'StellarWP\\Validation\\Contracts\\ValidatesOnFrontEnd',
    ),
  ),
  'StellarWP\\Validation\\Rules\\Exclude' => 
  array (
    'type' => 'class',
    'classname' => 'Exclude',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Rules',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Rules\\Exclude',
    'implements' => 
    array (
      0 => 'StellarWP\\Validation\\Contracts\\ValidationRule',
    ),
  ),
  'StellarWP\\Validation\\Rules\\ExcludeIf' => 
  array (
    'type' => 'class',
    'classname' => 'ExcludeIf',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Rules',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Rules\\ExcludeIf',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Validation\\Rules\\ExcludeUnless' => 
  array (
    'type' => 'class',
    'classname' => 'ExcludeUnless',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Rules',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Rules\\ExcludeUnless',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Validation\\Rules\\In' => 
  array (
    'type' => 'class',
    'classname' => 'In',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Rules',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Rules\\In',
    'implements' => 
    array (
      0 => 'StellarWP\\Validation\\Contracts\\ValidationRule',
      1 => 'StellarWP\\Validation\\Contracts\\ValidatesOnFrontEnd',
    ),
  ),
  'StellarWP\\Validation\\Rules\\InStrict' => 
  array (
    'type' => 'class',
    'classname' => 'InStrict',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Rules',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Rules\\InStrict',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Validation\\Rules\\Integer' => 
  array (
    'type' => 'class',
    'classname' => 'Integer',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Rules',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Rules\\Integer',
    'implements' => 
    array (
      0 => 'StellarWP\\Validation\\Contracts\\ValidationRule',
      1 => 'StellarWP\\Validation\\Contracts\\ValidatesOnFrontEnd',
      2 => 'StellarWP\\Validation\\Contracts\\Sanitizer',
    ),
  ),
  'StellarWP\\Validation\\Rules\\Max' => 
  array (
    'type' => 'class',
    'classname' => 'Max',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Rules',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Rules\\Max',
    'implements' => 
    array (
      0 => 'StellarWP\\Validation\\Contracts\\ValidationRule',
      1 => 'StellarWP\\Validation\\Contracts\\ValidatesOnFrontEnd',
    ),
  ),
  'StellarWP\\Validation\\Rules\\Min' => 
  array (
    'type' => 'class',
    'classname' => 'Min',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Rules',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Rules\\Min',
    'implements' => 
    array (
      0 => 'StellarWP\\Validation\\Contracts\\ValidationRule',
      1 => 'StellarWP\\Validation\\Contracts\\ValidatesOnFrontEnd',
    ),
  ),
  'StellarWP\\Validation\\Rules\\Nullable' => 
  array (
    'type' => 'class',
    'classname' => 'Nullable',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Rules',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Rules\\Nullable',
    'implements' => 
    array (
      0 => 'StellarWP\\Validation\\Contracts\\ValidationRule',
      1 => 'StellarWP\\Validation\\Contracts\\ValidatesOnFrontEnd',
    ),
  ),
  'StellarWP\\Validation\\Rules\\NullableIf' => 
  array (
    'type' => 'class',
    'classname' => 'NullableIf',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Rules',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Rules\\NullableIf',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Validation\\Rules\\NullableUnless' => 
  array (
    'type' => 'class',
    'classname' => 'NullableUnless',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Rules',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Rules\\NullableUnless',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Validation\\Rules\\Numeric' => 
  array (
    'type' => 'class',
    'classname' => 'Numeric',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Rules',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Rules\\Numeric',
    'implements' => 
    array (
      0 => 'StellarWP\\Validation\\Contracts\\ValidationRule',
      1 => 'StellarWP\\Validation\\Contracts\\ValidatesOnFrontEnd',
    ),
  ),
  'StellarWP\\Validation\\Rules\\Optional' => 
  array (
    'type' => 'class',
    'classname' => 'Optional',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Rules',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Rules\\Optional',
    'implements' => 
    array (
      0 => 'StellarWP\\Validation\\Contracts\\ValidationRule',
      1 => 'StellarWP\\Validation\\Contracts\\ValidatesOnFrontEnd',
    ),
  ),
  'StellarWP\\Validation\\Rules\\OptionalIf' => 
  array (
    'type' => 'class',
    'classname' => 'OptionalIf',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Rules',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Rules\\OptionalIf',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Validation\\Rules\\OptionalUnless' => 
  array (
    'type' => 'class',
    'classname' => 'OptionalUnless',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Rules',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Rules\\OptionalUnless',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Validation\\Rules\\Required' => 
  array (
    'type' => 'class',
    'classname' => 'Required',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Rules',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Rules\\Required',
    'implements' => 
    array (
      0 => 'StellarWP\\Validation\\Contracts\\ValidationRule',
      1 => 'StellarWP\\Validation\\Contracts\\ValidatesOnFrontEnd',
    ),
  ),
  'StellarWP\\Validation\\Rules\\Size' => 
  array (
    'type' => 'class',
    'classname' => 'Size',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Rules',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Rules\\Size',
    'implements' => 
    array (
      0 => 'StellarWP\\Validation\\Contracts\\ValidationRule',
      1 => 'StellarWP\\Validation\\Contracts\\ValidatesOnFrontEnd',
    ),
  ),
  'StellarWP\\Validation\\ServiceProvider' => 
  array (
    'type' => 'class',
    'classname' => 'ServiceProvider',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\ServiceProvider',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Validation\\ValidationRuleSet' => 
  array (
    'type' => 'class',
    'classname' => 'ValidationRuleSet',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\ValidationRuleSet',
    'implements' => 
    array (
      0 => 'IteratorAggregate',
      1 => 'JsonSerializable',
    ),
  ),
  'StellarWP\\Validation\\ValidationRulesRegistrar' => 
  array (
    'type' => 'class',
    'classname' => 'ValidationRulesRegistrar',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\ValidationRulesRegistrar',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Validation\\Validator' => 
  array (
    'type' => 'class',
    'classname' => 'Validator',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Validator',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Validation\\Tests\\TestCase' => 
  array (
    'type' => 'class',
    'classname' => 'TestCase',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Tests',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Tests\\TestCase',
    'implements' => 
    array (
    ),
  ),
  'unit\\Rules\\Abstracts\\ConditionalRuleTest' => 
  array (
    'type' => 'class',
    'classname' => 'ConditionalRuleTest',
    'isabstract' => false,
    'namespace' => 'unit\\Rules\\Abstracts',
    'extends' => 'SolidWP\\Mail\\unit\\Rules\\Abstracts\\ConditionalRuleTest',
    'implements' => 
    array (
    ),
  ),
  'unit\\Rules\\Abstracts\\MockConditionalRule' => 
  array (
    'type' => 'class',
    'classname' => 'MockConditionalRule',
    'isabstract' => false,
    'namespace' => 'unit\\Rules\\Abstracts',
    'extends' => 'SolidWP\\Mail\\unit\\Rules\\Abstracts\\MockConditionalRule',
    'implements' => 
    array (
    ),
  ),
  'unit\\Rules\\BooleanTest' => 
  array (
    'type' => 'class',
    'classname' => 'BooleanTest',
    'isabstract' => false,
    'namespace' => 'unit\\Rules',
    'extends' => 'SolidWP\\Mail\\unit\\Rules\\BooleanTest',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Validation\\Tests\\Unit\\Rules\\CurrencyTest' => 
  array (
    'type' => 'class',
    'classname' => 'CurrencyTest',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Tests\\Unit\\Rules',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Tests\\Unit\\Rules\\CurrencyTest',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Validation\\Tests\\Unit\\Rules\\DateTimeTest' => 
  array (
    'type' => 'class',
    'classname' => 'DateTimeTest',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Tests\\Unit\\Rules',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Tests\\Unit\\Rules\\DateTimeTest',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Validation\\Tests\\Unit\\Rules\\EmailTest' => 
  array (
    'type' => 'class',
    'classname' => 'EmailTest',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Tests\\Unit\\Rules',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Tests\\Unit\\Rules\\EmailTest',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Validation\\Tests\\Unit\\Rules\\ExcludeIfTest' => 
  array (
    'type' => 'class',
    'classname' => 'ExcludeIfTest',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Tests\\Unit\\Rules',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Tests\\Unit\\Rules\\ExcludeIfTest',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Validation\\Tests\\Unit\\Rules\\ExcludeTest' => 
  array (
    'type' => 'class',
    'classname' => 'ExcludeTest',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Tests\\Unit\\Rules',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Tests\\Unit\\Rules\\ExcludeTest',
    'implements' => 
    array (
    ),
  ),
  'unit\\Rules\\ExcludeUnlessTest' => 
  array (
    'type' => 'class',
    'classname' => 'ExcludeUnlessTest',
    'isabstract' => false,
    'namespace' => 'unit\\Rules',
    'extends' => 'SolidWP\\Mail\\unit\\Rules\\ExcludeUnlessTest',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Validation\\Tests\\Unit\\Rules\\InStrictTest' => 
  array (
    'type' => 'class',
    'classname' => 'InStrictTest',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Tests\\Unit\\Rules',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Tests\\Unit\\Rules\\InStrictTest',
    'implements' => 
    array (
    ),
  ),
  'unit\\Rules\\InTest' => 
  array (
    'type' => 'class',
    'classname' => 'InTest',
    'isabstract' => false,
    'namespace' => 'unit\\Rules',
    'extends' => 'SolidWP\\Mail\\unit\\Rules\\InTest',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Validation\\Tests\\Unit\\Rules\\IntegerTest' => 
  array (
    'type' => 'class',
    'classname' => 'IntegerTest',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Tests\\Unit\\Rules',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Tests\\Unit\\Rules\\IntegerTest',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Validation\\Tests\\Unit\\Rules\\MaxTest' => 
  array (
    'type' => 'class',
    'classname' => 'MaxTest',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Tests\\Unit\\Rules',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Tests\\Unit\\Rules\\MaxTest',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Validation\\Tests\\Unit\\Rules\\MinTest' => 
  array (
    'type' => 'class',
    'classname' => 'MinTest',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Tests\\Unit\\Rules',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Tests\\Unit\\Rules\\MinTest',
    'implements' => 
    array (
    ),
  ),
  'unit\\Rules\\NullableIfTest' => 
  array (
    'type' => 'class',
    'classname' => 'NullableIfTest',
    'isabstract' => false,
    'namespace' => 'unit\\Rules',
    'extends' => 'SolidWP\\Mail\\unit\\Rules\\NullableIfTest',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Validation\\Tests\\Unit\\Rules\\NullableTest' => 
  array (
    'type' => 'class',
    'classname' => 'NullableTest',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Tests\\Unit\\Rules',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Tests\\Unit\\Rules\\NullableTest',
    'implements' => 
    array (
    ),
  ),
  'unit\\Rules\\NullableUnlessTest' => 
  array (
    'type' => 'class',
    'classname' => 'NullableUnlessTest',
    'isabstract' => false,
    'namespace' => 'unit\\Rules',
    'extends' => 'SolidWP\\Mail\\unit\\Rules\\NullableUnlessTest',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Validation\\Tests\\Unit\\Rules\\NumericTest' => 
  array (
    'type' => 'class',
    'classname' => 'NumericTest',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Tests\\Unit\\Rules',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Tests\\Unit\\Rules\\NumericTest',
    'implements' => 
    array (
    ),
  ),
  'unit\\Rules\\OptionalIfTest' => 
  array (
    'type' => 'class',
    'classname' => 'OptionalIfTest',
    'isabstract' => false,
    'namespace' => 'unit\\Rules',
    'extends' => 'SolidWP\\Mail\\unit\\Rules\\OptionalIfTest',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Validation\\Tests\\Unit\\Rules\\OptionalTest' => 
  array (
    'type' => 'class',
    'classname' => 'OptionalTest',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Tests\\Unit\\Rules',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Tests\\Unit\\Rules\\OptionalTest',
    'implements' => 
    array (
    ),
  ),
  'unit\\Rules\\OptionalUnlessTest' => 
  array (
    'type' => 'class',
    'classname' => 'OptionalUnlessTest',
    'isabstract' => false,
    'namespace' => 'unit\\Rules',
    'extends' => 'SolidWP\\Mail\\unit\\Rules\\OptionalUnlessTest',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Validation\\Tests\\Unit\\Rules\\RequiredTest' => 
  array (
    'type' => 'class',
    'classname' => 'RequiredTest',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Tests\\Unit\\Rules',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Tests\\Unit\\Rules\\RequiredTest',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Validation\\Tests\\Unit\\Rules\\SizeTest' => 
  array (
    'type' => 'class',
    'classname' => 'SizeTest',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Tests\\Unit\\Rules',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Tests\\Unit\\Rules\\SizeTest',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Validation\\Tests\\Unit\\Framework\\Validation\\ValidationRuleSetTest' => 
  array (
    'type' => 'class',
    'classname' => 'ValidationRuleSetTest',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Tests\\Unit\\Framework\\Validation',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Tests\\Unit\\Framework\\Validation\\ValidationRuleSetTest',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Validation\\Tests\\Unit\\ValidatorTest' => 
  array (
    'type' => 'class',
    'classname' => 'ValidatorTest',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Tests\\Unit',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Tests\\Unit\\ValidatorTest',
    'implements' => 
    array (
    ),
  ),
  'StellarWP\\Validation\\Tests\\Unit\\MockSkipRule' => 
  array (
    'type' => 'class',
    'classname' => 'MockSkipRule',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Tests\\Unit',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Tests\\Unit\\MockSkipRule',
    'implements' => 
    array (
      0 => 'StellarWP\\Validation\\Contracts\\ValidationRule',
    ),
  ),
  'StellarWP\\Validation\\Tests\\Unit\\MockRequiredRule' => 
  array (
    'type' => 'class',
    'classname' => 'MockRequiredRule',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Tests\\Unit',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Tests\\Unit\\MockRequiredRule',
    'implements' => 
    array (
      0 => 'StellarWP\\Validation\\Contracts\\ValidationRule',
    ),
  ),
  'StellarWP\\Validation\\Tests\\Unit\\MockIntegerRule' => 
  array (
    'type' => 'class',
    'classname' => 'MockIntegerRule',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Tests\\Unit',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Tests\\Unit\\MockIntegerRule',
    'implements' => 
    array (
      0 => 'StellarWP\\Validation\\Contracts\\ValidationRule',
      1 => 'StellarWP\\Validation\\Contracts\\Sanitizer',
    ),
  ),
  'StellarWP\\Validation\\Tests\\Unit\\MockExcludeRule' => 
  array (
    'type' => 'class',
    'classname' => 'MockExcludeRule',
    'isabstract' => false,
    'namespace' => 'StellarWP\\Validation\\Tests\\Unit',
    'extends' => 'SolidWP\\Mail\\StellarWP\\Validation\\Tests\\Unit\\MockExcludeRule',
    'implements' => 
    array (
      0 => 'StellarWP\\Validation\\Contracts\\ValidationRule',
    ),
  ),
  'StellarWP\\FieldConditions\\Concerns\\HasConditions' => 
  array (
    'type' => 'trait',
    'traitname' => 'HasConditions',
    'namespace' => 'StellarWP\\FieldConditions\\Concerns',
    'use' => 
    array (
      0 => 'SolidWP\\Mail\\StellarWP\\FieldConditions\\Concerns\\HasConditions',
    ),
  ),
  'StellarWP\\FieldConditions\\Concerns\\HasLogicalOperator' => 
  array (
    'type' => 'trait',
    'traitname' => 'HasLogicalOperator',
    'namespace' => 'StellarWP\\FieldConditions\\Concerns',
    'use' => 
    array (
      0 => 'SolidWP\\Mail\\StellarWP\\FieldConditions\\Concerns\\HasLogicalOperator',
    ),
  ),
  'StellarWP\\Validation\\Concerns\\HasValidationRules' => 
  array (
    'type' => 'trait',
    'traitname' => 'HasValidationRules',
    'namespace' => 'StellarWP\\Validation\\Concerns',
    'use' => 
    array (
      0 => 'SolidWP\\Mail\\StellarWP\\Validation\\Concerns\\HasValidationRules',
    ),
  ),
  'lucatume\\DI52\\Builders\\BuilderInterface' => 
  array (
    'type' => 'interface',
    'interfacename' => 'BuilderInterface',
    'namespace' => 'lucatume\\DI52\\Builders',
    'extends' => 
    array (
      0 => 'SolidWP\\Mail\\lucatume\\DI52\\Builders\\BuilderInterface',
    ),
  ),
  'lucatume\\DI52\\Builders\\ReinitializableBuilderInterface' => 
  array (
    'type' => 'interface',
    'interfacename' => 'ReinitializableBuilderInterface',
    'namespace' => 'lucatume\\DI52\\Builders',
    'extends' => 
    array (
      0 => 'SolidWP\\Mail\\lucatume\\DI52\\Builders\\ReinitializableBuilderInterface',
    ),
  ),
  'Psr\\Container\\ContainerExceptionInterface' => 
  array (
    'type' => 'interface',
    'interfacename' => 'ContainerExceptionInterface',
    'namespace' => 'Psr\\Container',
    'extends' => 
    array (
      0 => 'SolidWP\\Mail\\Psr\\Container\\ContainerExceptionInterface',
    ),
  ),
  'Psr\\Container\\ContainerInterface' => 
  array (
    'type' => 'interface',
    'interfacename' => 'ContainerInterface',
    'namespace' => 'Psr\\Container',
    'extends' => 
    array (
      0 => 'SolidWP\\Mail\\Psr\\Container\\ContainerInterface',
    ),
  ),
  'Psr\\Container\\NotFoundExceptionInterface' => 
  array (
    'type' => 'interface',
    'interfacename' => 'NotFoundExceptionInterface',
    'namespace' => 'Psr\\Container',
    'extends' => 
    array (
      0 => 'SolidWP\\Mail\\Psr\\Container\\NotFoundExceptionInterface',
    ),
  ),
  'StellarWP\\ContainerContract\\ContainerInterface' => 
  array (
    'type' => 'interface',
    'interfacename' => 'ContainerInterface',
    'namespace' => 'StellarWP\\ContainerContract',
    'extends' => 
    array (
      0 => 'SolidWP\\Mail\\StellarWP\\ContainerContract\\ContainerInterface',
    ),
  ),
  'StellarWP\\FieldConditions\\Contracts\\Condition' => 
  array (
    'type' => 'interface',
    'interfacename' => 'Condition',
    'namespace' => 'StellarWP\\FieldConditions\\Contracts',
    'extends' => 
    array (
      0 => 'SolidWP\\Mail\\StellarWP\\FieldConditions\\Contracts\\Condition',
    ),
  ),
  'StellarWP\\FieldConditions\\Contracts\\ConditionSet' => 
  array (
    'type' => 'interface',
    'interfacename' => 'ConditionSet',
    'namespace' => 'StellarWP\\FieldConditions\\Contracts',
    'extends' => 
    array (
      0 => 'SolidWP\\Mail\\StellarWP\\FieldConditions\\Contracts\\ConditionSet',
    ),
  ),
  'StellarWP\\Telemetry\\Contracts\\Data_Provider' => 
  array (
    'type' => 'interface',
    'interfacename' => 'Data_Provider',
    'namespace' => 'StellarWP\\Telemetry\\Contracts',
    'extends' => 
    array (
      0 => 'SolidWP\\Mail\\StellarWP\\Telemetry\\Contracts\\Data_Provider',
    ),
  ),
  'StellarWP\\Telemetry\\Contracts\\Runnable' => 
  array (
    'type' => 'interface',
    'interfacename' => 'Runnable',
    'namespace' => 'StellarWP\\Telemetry\\Contracts',
    'extends' => 
    array (
      0 => 'SolidWP\\Mail\\StellarWP\\Telemetry\\Contracts\\Runnable',
    ),
  ),
  'StellarWP\\Telemetry\\Contracts\\Subscriber_Interface' => 
  array (
    'type' => 'interface',
    'interfacename' => 'Subscriber_Interface',
    'namespace' => 'StellarWP\\Telemetry\\Contracts',
    'extends' => 
    array (
      0 => 'SolidWP\\Mail\\StellarWP\\Telemetry\\Contracts\\Subscriber_Interface',
    ),
  ),
  'StellarWP\\Telemetry\\Contracts\\Template_Interface' => 
  array (
    'type' => 'interface',
    'interfacename' => 'Template_Interface',
    'namespace' => 'StellarWP\\Telemetry\\Contracts',
    'extends' => 
    array (
      0 => 'SolidWP\\Mail\\StellarWP\\Telemetry\\Contracts\\Template_Interface',
    ),
  ),
  'StellarWP\\Validation\\Contracts\\Sanitizer' => 
  array (
    'type' => 'interface',
    'interfacename' => 'Sanitizer',
    'namespace' => 'StellarWP\\Validation\\Contracts',
    'extends' => 
    array (
      0 => 'SolidWP\\Mail\\StellarWP\\Validation\\Contracts\\Sanitizer',
    ),
  ),
  'StellarWP\\Validation\\Contracts\\ValidatesOnFrontEnd' => 
  array (
    'type' => 'interface',
    'interfacename' => 'ValidatesOnFrontEnd',
    'namespace' => 'StellarWP\\Validation\\Contracts',
    'extends' => 
    array (
      0 => 'SolidWP\\Mail\\StellarWP\\Validation\\Contracts\\ValidatesOnFrontEnd',
    ),
  ),
  'StellarWP\\Validation\\Contracts\\ValidationRule' => 
  array (
    'type' => 'interface',
    'interfacename' => 'ValidationRule',
    'namespace' => 'StellarWP\\Validation\\Contracts',
    'extends' => 
    array (
      0 => 'SolidWP\\Mail\\StellarWP\\Validation\\Contracts\\ValidationRule',
    ),
  ),
  'StellarWP\\Validation\\Exceptions\\Contracts\\ValidationExceptionInterface' => 
  array (
    'type' => 'interface',
    'interfacename' => 'ValidationExceptionInterface',
    'namespace' => 'StellarWP\\Validation\\Exceptions\\Contracts',
    'extends' => 
    array (
      0 => 'SolidWP\\Mail\\StellarWP\\Validation\\Exceptions\\Contracts\\ValidationExceptionInterface',
    ),
  ),
);

        public function __construct()
        {
            $this->includeFilePath = __DIR__ . '/autoload_alias.php';
        }

        /**
         * @param string $class
         */
        public function autoload($class): void
        {
            if (!isset($this->autoloadAliases[$class])) {
                return;
            }
            switch ($this->autoloadAliases[$class]['type']) {
                case 'class':
                        $this->load(
                            $this->classTemplate(
                                $this->autoloadAliases[$class]
                            )
                        );
                    break;
                case 'interface':
                    $this->load(
                        $this->interfaceTemplate(
                            $this->autoloadAliases[$class]
                        )
                    );
                    break;
                case 'trait':
                    $this->load(
                        $this->traitTemplate(
                            $this->autoloadAliases[$class]
                        )
                    );
                    break;
                default:
                    // Never.
                    break;
            }
        }

        private function load(string $includeFile): void
        {
            file_put_contents($this->includeFilePath, $includeFile);
            include $this->includeFilePath;
            file_exists($this->includeFilePath) && unlink($this->includeFilePath);
        }

        /**
         * @param ClassAliasArray $class
         */
        private function classTemplate(array $class): string
        {
            $abstract = $class['isabstract'] ? 'abstract ' : '';
            $classname = $class['classname'];
            if (isset($class['namespace'])) {
                $namespace = "namespace {$class['namespace']};";
                $extends = '\\' . $class['extends'];
                $implements = empty($class['implements']) ? ''
                : ' implements \\' . implode(', \\', $class['implements']);
            } else {
                $namespace = '';
                $extends = $class['extends'];
                $implements = !empty($class['implements']) ? ''
                : ' implements ' . implode(', ', $class['implements']);
            }
            return <<<EOD
                <?php
                $namespace
                $abstract class $classname extends $extends $implements {}
                EOD;
        }

        /**
         * @param InterfaceAliasArray $interface
         */
        private function interfaceTemplate(array $interface): string
        {
            $interfacename = $interface['interfacename'];
            $namespace = isset($interface['namespace'])
            ? "namespace {$interface['namespace']};" : '';
            $extends = isset($interface['namespace'])
            ? '\\' . implode('\\ ,', $interface['extends'])
            : implode(', ', $interface['extends']);
            return <<<EOD
                <?php
                $namespace
                interface $interfacename extends $extends {}
                EOD;
        }

        /**
         * @param TraitAliasArray $trait
         */
        private function traitTemplate(array $trait): string
        {
            $traitname = $trait['traitname'];
            $namespace = isset($trait['namespace'])
            ? "namespace {$trait['namespace']};" : '';
            $uses = isset($trait['namespace'])
            ? '\\' . implode(';' . PHP_EOL . '    use \\', $trait['use'])
            : implode(';' . PHP_EOL . '    use ', $trait['use']);
            return <<<EOD
                <?php
                $namespace
                trait $traitname { 
                    use $uses; 
                }
                EOD;
        }
    }

    spl_autoload_register([ new AliasAutoloader(), 'autoload' ]);
}
