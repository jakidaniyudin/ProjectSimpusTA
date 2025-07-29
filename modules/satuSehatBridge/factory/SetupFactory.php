<?php 

require_once (APPPATH . 'modules/satuSehatBridge/interface/InterfaceSetup.php');
require_once (APPPATH . 'modules/satuSehatBridge/repository/SetUp/serviceSetupANC.php');
class SetupFactory {
    public function setUpManajemen ($setUpName):InterfaceSetup{
       switch ($setUpName) {
        case 'ecounter': return new EcounterANCSetup();
        case 'episode_of_care': return new EpisodeOfCareSetup();
        case 'condtion_riwayat': return new ConditionRiwayat();
        case 'condition_complication': return new ConditionPemantauan();
        case 'observation_int': return new ObservationIntSetup();
        case 'observation_datetime': return new ObservationDateTimeSetup();
        case 'observation_quantity_value': return new ObservationQuantitySetup();
        case 'observation_string': return new ObservationStringSetup();
        case 'observation_quantity_interpretation': return new ObservationQuantityInterpretationSetup();
        case 'observation_insterpretation': return new ObservationInterpretationSetup();
        case 'observation_interpretation_bodysheet': return new ObservationInterpretationBodySheetSetup();
        case 'observation_range': return new ObservationRangeSetup();
        case 'observation-codelabel': return new ObservationCodeLabelSetup();
        case 'ecounter_inc': return new EcounterIncSetup();
        case 'ecounter_kematian': return new EcounterKematianSetup();
        default: return null;
        }
    }
}