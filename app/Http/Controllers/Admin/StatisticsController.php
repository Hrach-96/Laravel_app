<?php

namespace App\Http\Controllers\Admin;


use App\RegisterSurvey;
use App\School;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Charts;


class StatisticsController extends Controller
{


    // Statistics
    public  function Statistics(Request $request){
        $user_id = Session::get('userData')->id;
        $degrees = $request->input('degree');
        $year_of_graduation = $request->input('year_of_graduation');
        $categorys = $request->input('category');
        $users = User::where('type','<>',User::super_admin)
            ->where(function ($sql) use ($degrees,$year_of_graduation,$categorys){
                $sql->Where(function ($query) use ($degrees){
                    if(!empty($degrees)) {
                        $query->WhereHas('chooseDegree', function ($q) use ($degrees) {
                            $q->whereHas('degree', function ($query1) use ($degrees) {
                                $query1->Where('name',$degrees);
                            });
                        });
                    }
                })->Where(function ($query) use ($categorys){
                    if(!empty($categorys)) {
                        $query->WhereHas('chooseColor', function ($q) use ($categorys) {
                            $q->whereHas('category', function ($query1) use ($categorys) {
                                $query1->Where('title',$categorys);
                            });
                        });
                    }
                })->Where(function ($query) use ($year_of_graduation){
                    if(!empty($year_of_graduation)){
                        $query->WhereHas('GetGraduationYear', function ($q) use($year_of_graduation) {
                            $q->Where('year',$year_of_graduation);
                        });
                    }
                });
            })->orderBy('id', 'DESC')->get();

        $chart = Charts::create('pie', 'highcharts')
            ->title('Pourcentage de compte activés')
            ->labels(['Active Users', 'Not Active'])
            ->values([$users->where('status',User::status_active)->where('type',User::user)->count(),$users->where('status',User::status_inactive)->where('type',User::user)->count()]);

        $all_users_count = $users->where('status',User::status_active)->where('type',User::user)->count();
        $mentor_users = $users->where('status',User::status_active)->where('type',User::user)->where('mentorat',User::mentorat)->count();
        if ($all_users_count == 0){
            $procent_of_mentors = 0;
        }else{
            $procent_of_mentors = ceil($mentor_users*100/$all_users_count);
        }
        $survey_answers = RegisterSurvey::all();
        $time_to_first_find_job = [];
        $nature_of_contract = [];
        $what_area_this_job = [];
        $full_time_or_part_time_job = [];
        $salary_bracket = [];
        $before_entering_old_degree = [];
        $foloowed_sector = [];
        $your_rate_overall_satisfaction_training = [];
        foreach($survey_answers as $each_answer){
            if(isset(json_decode($each_answer['answers'])->time_to_first_find_job)){
                $time_to_first_find_job[json_decode($each_answer['answers'])->time_to_first_find_job][] = json_decode($each_answer['answers'])->time_to_first_find_job;
            }
            if(isset(json_decode($each_answer['answers'])->nature_of_contract)){
                $nature_of_contract[json_decode($each_answer['answers'])->nature_of_contract][] = json_decode($each_answer['answers'])->nature_of_contract;
            }

            if(isset(json_decode($each_answer['answers'])->what_area_this_job)){
                $what_area_this_job[json_decode($each_answer['answers'])->what_area_this_job][] = json_decode($each_answer['answers'])->what_area_this_job;
            }

            if(isset(json_decode($each_answer['answers'])->full_time_or_part_time_job)){
                $full_time_or_part_time_job[json_decode($each_answer['answers'])->full_time_or_part_time_job][] = json_decode($each_answer['answers'])->full_time_or_part_time_job;
            }

            if(isset(json_decode($each_answer['answers'])->salary_bracket)){
                $salary_bracket[json_decode($each_answer['answers'])->salary_bracket][] = json_decode($each_answer['answers'])->salary_bracket;
            }

            if(isset(json_decode($each_answer['answers'])->before_entering_old_degree)){
                $before_entering_old_degree[json_decode($each_answer['answers'])->before_entering_old_degree][] = json_decode($each_answer['answers'])->before_entering_old_degree;
            }

            if(isset(json_decode($each_answer['answers'])->foloowed_sector)){
                $foloowed_sector[json_decode($each_answer['answers'])->foloowed_sector][] = json_decode($each_answer['answers'])->foloowed_sector;
            }

            if(isset(json_decode($each_answer['answers'])->quality_of_lessons)){
                $quality_of_lessons[json_decode($each_answer['answers'])->quality_of_lessons][] = json_decode($each_answer['answers'])->quality_of_lessons;
            }

            if(isset(json_decode($each_answer['answers'])->your_rate_overall_satisfaction_training)){
                $your_rate_overall_satisfaction_training[json_decode($each_answer['answers'])->your_rate_overall_satisfaction_training][] = json_decode($each_answer['answers'])->your_rate_overall_satisfaction_training;
            }

            if(isset(json_decode($each_answer['answers'])->after_this_training)){
                $after_this_training[json_decode($each_answer['answers'])->after_this_training][] = json_decode($each_answer['answers'])->after_this_training;
            }

        }
        $chart_after_this_training= Charts::create('pie', 'highcharts')
            ->title('Que font vos étudiants après votre formation ?')
            ->labels(['Another Training','Went to trip','Found Job'])
            ->values([
                (isset($after_this_training['I did another training']))?count($after_this_training['I did another training']):'0',
                (isset($after_this_training['I went on a trip']))?count($after_this_training['I went on a trip']):'0',
                (isset($after_this_training['I fount job']))?count($after_this_training['I fount job']):'0',
            ]);
        $chart_your_rate_overall_satisfaction_training= Charts::create('donut', 'highcharts')
            ->title('Quelle est la satisfaction globale de la formation ?')
            ->labels(['1','2','3','4','5','6','7','8','9','10'])
            ->values([
                (isset($your_rate_overall_satisfaction_training['1']))?count($your_rate_overall_satisfaction_training['1']):'0',
                (isset($your_rate_overall_satisfaction_training['2']))?count($your_rate_overall_satisfaction_training['2']):'0',
                (isset($your_rate_overall_satisfaction_training['3']))?count($your_rate_overall_satisfaction_training['3']):'0',
                (isset($your_rate_overall_satisfaction_training['4']))?count($your_rate_overall_satisfaction_training['4']):'0',
                (isset($your_rate_overall_satisfaction_training['5']))?count($your_rate_overall_satisfaction_training['5']):'0',
                (isset($your_rate_overall_satisfaction_training['6']))?count($your_rate_overall_satisfaction_training['6']):'0',
                (isset($your_rate_overall_satisfaction_training['7']))?count($your_rate_overall_satisfaction_training['7']):'0',
                (isset($your_rate_overall_satisfaction_training['8']))?count($your_rate_overall_satisfaction_training['8']):'0',
                (isset($your_rate_overall_satisfaction_training['9']))?count($your_rate_overall_satisfaction_training['9']):'0',
                (isset($your_rate_overall_satisfaction_training['10']))?count($your_rate_overall_satisfaction_training['10']):'0',
            ]);
        $chart_quality_of_lessons= Charts::create('bar', 'highcharts')
            ->title('Quelle est la qualité des enseignements reçus selon vos alumni ?')
            ->labels(['1','2','3','4','5','6','7','8','9','10',])
            ->values([
                (isset($quality_of_lessons['1']))?count($quality_of_lessons['1']):'0',
                (isset($quality_of_lessons['2']))?count($quality_of_lessons['2']):'0',
                (isset($quality_of_lessons['3']))?count($quality_of_lessons['3']):'0',
                (isset($quality_of_lessons['4']))?count($quality_of_lessons['4']):'0',
                (isset($quality_of_lessons['5']))?count($quality_of_lessons['5']):'0',
                (isset($quality_of_lessons['6']))?count($quality_of_lessons['6']):'0',
                (isset($quality_of_lessons['7']))?count($quality_of_lessons['7']):'0',
                (isset($quality_of_lessons['8']))?count($quality_of_lessons['8']):'0',
                (isset($quality_of_lessons['9']))?count($quality_of_lessons['9']):'0',
                (isset($quality_of_lessons['10']))?count($quality_of_lessons['10']):'0',
            ]);
        $chart_foloowed_sector= Charts::create('bar', 'highcharts')
            ->title('D’où proviennent vos étudiants ?')
            ->labels(['Bac ES (économique et social)', 'Bac L (littéraire)', 'Bac S (scientifique)', 'Bac technologique ST2S', 'Bac technologique STAV', 'Bac technologique STD2A', 'Bac technologique STHR', 'Bac technologique STI2D', 'Bac technologique STL', 'Bac technologique STMG', 'Bac technologique TMD'])
            ->values([
                (isset($foloowed_sector['Bac ES (économique et social)']))?count($foloowed_sector['Bac ES (économique et social)']):'0',
                (isset($foloowed_sector['Bac L (littéraire)']))?count($foloowed_sector['Bac L (littéraire)']):'0',
                (isset($foloowed_sector['Bac S (scientifique)']))?count($foloowed_sector['Bac S (scientifique)']):'0',
                (isset($foloowed_sector['Bac technologique ST2S']))?count($foloowed_sector['Bac technologique ST2S']):'0',
                (isset($foloowed_sector['Bac technologique STAV']))?count($foloowed_sector['Bac technologique STAV']):'0',
                (isset($foloowed_sector['Bac technologique STD2A']))?count($foloowed_sector['Bac technologique STD2A']):'0',
                (isset($foloowed_sector['Bac technologique STHR']))?count($foloowed_sector['Bac technologique STHR']):'0',
                (isset($foloowed_sector['Bac technologique STI2D']))?count($foloowed_sector['Bac technologique STI2D']):'0',
                (isset($foloowed_sector['Bac technologique STL']))?count($foloowed_sector['Bac technologique STL']):'0',
                (isset($foloowed_sector['Bac technologique STMG']))?count($foloowed_sector['Bac technologique STMG']):'0',
                (isset($foloowed_sector['Bac technologique TMD']))?count($foloowed_sector['Bac technologique TMD']):'0',
            ]);

        $chart_before_entering_old_degree= Charts::create('bar', 'highcharts')
            ->title('D’où proviennent vos étudiants ?')
            ->labels(['Classe préparatoire (CPGE)', 'BTS', 'BTSA', 'DUT', 'PACES', 'Bachelor', 'Licence', 'Licence professionnelle', 'Master 1', 'Master 2', 'DCG', 'DSCG','Doctorat','Autre'])
            ->values([
                (isset($before_entering_old_degree['Classe préparatoire (CPGE)']))?count($before_entering_old_degree['Classe préparatoire (CPGE)']):'0',
                (isset($before_entering_old_degree['BTS']))?count($before_entering_old_degree['BTS']):'0',
                (isset($before_entering_old_degree['BTSA']))?count($before_entering_old_degree['BTSA']):'0',
                (isset($before_entering_old_degree['DUT']))?count($before_entering_old_degree['DUT']):'0',
                (isset($before_entering_old_degree['PACES']))?count($before_entering_old_degree['PACES']):'0',
                (isset($before_entering_old_degree['Bachelor']))?count($before_entering_old_degree['Bachelor']):'0',
                (isset($before_entering_old_degree['Licence']))?count($before_entering_old_degree['Licence']):'0',
                (isset($before_entering_old_degree['Licence professionnelle']))?count($before_entering_old_degree['Licence professionnelle']):'0',
                (isset($before_entering_old_degree['Master 1']))?count($before_entering_old_degree['Master 1']):'0',
                (isset($before_entering_old_degree['Master 2']))?count($before_entering_old_degree['Master 2']):'0',
                (isset($before_entering_old_degree['DCG']))?count($before_entering_old_degree['DCG']):'0',
                (isset($before_entering_old_degree['DSCG']))?count($before_entering_old_degree['DSCG']):'0',
                (isset($before_entering_old_degree['Doctorat']))?count($before_entering_old_degree['Doctorat']):'0',
                (isset($before_entering_old_degree['Autre']))?count($before_entering_old_degree['Autre']):'0'
            ]);

        $chart_time_to_first_find_job = Charts::create('bar', 'highcharts')
            ->title('Temps de recherche du premier emploi')
            ->labels(['0-2 ans', '3-6 mois', '6-9 mois', '9-12 mois', '+12 mois'])
            ->values([
                (isset($time_to_first_find_job['0-3 mois']))?count($time_to_first_find_job['0-3 mois']):'0',
                (isset($time_to_first_find_job['3-6 mois']))?count($time_to_first_find_job['3-6 mois']):'0',
                (isset($time_to_first_find_job['6-9 mois']))?count($time_to_first_find_job['6-9 mois']):'0',
                (isset($time_to_first_find_job['9-12 mois']))?count($time_to_first_find_job['9-12 mois']):'0',
                (isset($time_to_first_find_job['+12 moisns']))?count($time_to_first_find_job['+12 moisns']):'0'
            ]);

        $chart_nature_of_contract = Charts::create('donut', 'highcharts')
            ->title('Type de contrat du premier emploi')
            ->labels(['Stage', 'Altenance', 'Profession libérale, indépendant, chef d\'entreprise, auto-entrepreneur', 'Intérim', 'CDD','CDI','VIA','VIE','Fonctionnaire'])
            ->values([
                (isset($nature_of_contract['Stage']))?count($nature_of_contract['Stage']):'0',
                (isset($nature_of_contract['Altenance']))?count($nature_of_contract['Altenance']):'0',
                (isset($nature_of_contract['Profession libérale, indépendant, chef dentreprise, auto-entrepreneur']))?count($nature_of_contract['Profession libérale, indépendant, chef dentreprise, auto-entrepreneur']):'0',
                (isset($nature_of_contract['Intérim']))?count($nature_of_contract['Intérim']):'0',
                (isset($nature_of_contract['CDD']))?count($nature_of_contract['CDD']):'0',
                (isset($nature_of_contract['CDI']))?count($nature_of_contract['CDI']):'0',
                (isset($nature_of_contract['VIA']))?count($nature_of_contract['VIA']):'0',
                (isset($nature_of_contract['VIE']))?count($nature_of_contract['VIE']):'0',
                (isset($nature_of_contract['Fonctionnaire']))?count($nature_of_contract['Fonctionnaire']):'0'
            ]);

        $chart_what_area_this_job = Charts::create('pie', 'highcharts')
            ->title('Dans quel secteur d’activité travaillent vos alumni ?')
            ->labels([
                'Architecture',
                'Banque / Assurance / Finance',
                'Conseil / Audit',
                'Culture / Media / Divertissement',
                'Distribution',
                'Education / Formation / Recrutement',
                'Entrepreneuriat / Start-up',
                'Agro-alimentaire',
                'Hotellerie / Tourism / Loisirs',
                'Immobilier',
                'Industrie',
                'Droit',
                'Publicité / Marketing / Agence',
                'Mode / Luxe / Beauté',
                'Santé / Social / Environnement',
                'Secteur public et administration',
                'Digital / Tech'
            ])
            ->values([
                (isset($what_area_this_job['Architecture']))?count($what_area_this_job['Architecture']):'0',
                (isset($what_area_this_job['Banque / Assurance / Finance']))?count($what_area_this_job['Banque / Assurance / Finance']):'0',
                (isset($what_area_this_job['Conseil / Audit']))?count($what_area_this_job['Conseil / Audit']):'0',
                (isset($what_area_this_job['Culture / Media / Divertissement']))?count($what_area_this_job['Culture / Media / Divertissement']):'0',
                (isset($what_area_this_job['Distribution']))?count($what_area_this_job['Distribution']):'0',
                (isset($what_area_this_job['Education / Formation / Recrutement']))?count($what_area_this_job['Education / Formation / Recrutement']):'0',
                (isset($what_area_this_job['Entrepreneuriat / Start-up']))?count($what_area_this_job['Entrepreneuriat / Start-up']):'0',
                (isset($what_area_this_job['Agro-alimentaire']))?count($what_area_this_job['Agro-alimentaire']):'0',
                (isset($what_area_this_job['Hotellerie / Tourism / Loisirs']))?count($what_area_this_job['Hotellerie / Tourism / Loisirs']):'0',
                (isset($what_area_this_job['Immobilier']))?count($what_area_this_job['Immobilier']):'0',
                (isset($what_area_this_job['Industrie']))?count($what_area_this_job['Industrie']):'0',
                (isset($what_area_this_job['Droit']))?count($what_area_this_job['Droit']):'0',
                (isset($what_area_this_job['Publicité / Marketing / Agence']))?count($what_area_this_job['Publicité / Marketing / Agence']):'0',
                (isset($what_area_this_job['Mode / Luxe / Beauté']))?count($what_area_this_job['Mode / Luxe / Beauté']):'0',
                (isset($what_area_this_job['Santé / Social / Environnement']))?count($what_area_this_job['Santé / Social / Environnement']):'0',
                (isset($what_area_this_job['Santé / Social / Environnement']))?count($what_area_this_job['Santé / Social / Environnement']):'0',
                (isset($what_area_this_job['Digital / Tech']))?count($what_area_this_job['Digital / Tech']):'0',
            ]);

        $chart_full_time_or_part_time_job = Charts::create('bar', 'highcharts')
            ->title('Quel type d’emploi après votre formation ?')
            ->labels(['Temps plein', 'Temps partiel'])
            ->values([
                (isset($full_time_or_part_time_job['Full Time']))?count($full_time_or_part_time_job['Full Time']):'0',
                (isset($full_time_or_part_time_job['Part Time']))?count($full_time_or_part_time_job['Part Time']):'0',
            ]);

        $salary_bracket_10 = isset($salary_bracket['10'])?count($salary_bracket['10']):'0';
        unset($salary_bracket['10']);
        $chart_salary_bracket = Charts::create('bar', 'highcharts')
                ->title('Quelle rémunération après votre formation ?')
                ->labels(['jeune diplômé', 'Diplômé'])
                ->values([
                    (isset($salary_bracket))?count($salary_bracket):'0',
                    $salary_bracket_10
                ]);

        $school = parent::GetSubDomain($request->getHost());
        $schoolInfo = School::where('subdomain_name',$school)->first();
        return view('admin.statistics.statistics',compact('chart','schoolInfo','chart_after_this_training','chart_your_rate_overall_satisfaction_training','chart_quality_of_lessons', 'chart_foloowed_sector','chart_before_entering_old_degree','chart_time_to_first_find_job','chart_nature_of_contract','chart_what_area_this_job','chart_full_time_or_part_time_job','chart_salary_bracket','procent_of_mentors','chart_for_mentor','users','user_id','degrees','year_of_graduation','categorys'));
    }
}
