<?php
/**
 * Created by PhpStorm.
 * User: FranQ
 * Date: 14.10.2019
 * Time: 15:46
 */

require_once '../core/Dao/KeywordDao.php';
require_once '../core/Dao/SummaryDao.php';
require_once '../core/Dao/SummaryKeywordDao.php';
require_once '../core/Dao/WorkPlaceDao.php';
require_once '../core/Dao/EducationDao.php';
require_once '../core/Dao/Vacancy.php';
require_once '../core/Dao/SkillVacancy.php';
require_once '../core/Dao/DutiesVacancy.php';
require_once '../core/Dao/SuggestVacancyDao.php';
require_once '../core/Dao/SkillKeywordDao.php';
require_once '../core/Dao/DutiesKeywordDao.php';
require_once '../core/Dao/SkillDao.php';
require_once '../core/Dao/FileVacancyDao.php';
require_once '../core/Dao/AutoAnswerDao.php';
require_once '../core/Dao/SummaryVacancyDao.php';

require_once '../../vendor/autoload.php';

ini_set("display_errors", 1);
error_reporting(E_ERROR | E_PARSE);

class API
{

  private $keywordDao;
  private $summaryDao;
  private $workPlaceDao;
  private $educationDao;
  private $summaryKeywordsDao;
  private $vacancy;
  private $skillVacancy;
  private $dutiesVacancy;
  private $suggestVacancyDao;
  private $skillKeywordDao;
  private $dutiesKeywordDao;
  private $skillDao;
  private $fileVacancyDao;
  private $autoAnswerDao;
  private $summaryVacancyDao;

  public function __construct()
  {
    $this->keywordDao = new KeywordDao();
    $this->summaryDao = new SummaryDao();
    $this->workPlaceDao = new WorkPlaceDao();
    $this->educationDao = new EducationDao();
    $this->summaryKeywordsDao = new SummaryKeywordDao();
    $this->vacancy = new Vacancy();
    $this->skillVacancy = new SkillVacancy();
    $this->dutiesVacancy = new DutiesVacancy();
    $this->suggestVacancyDao = new SuggestVacancyDao();
    $this->skillKeywordDao = new SkillKeywordDao();
    $this->dutiesKeywordDao = new DutiesKeywordDao();
    $this->skillDao = new SkillDao();
    $this->fileVacancyDao = new FileVacancyDao();
    $this->autoAnswerDao = new AutoAnswerDao();
    $this->summaryVacancyDao = new SummaryVacancyDao();
  }

  public function test()
  {
    return ["test" => "hello!"];
  }

  public function getKeywords()
  {
    return $this->keywordDao->getList();
  }

  public function findKeyword($args)
  {
    $query = $args['query'];
    return $this->keywordDao->findKeyword($query);
  }

  public function getSummaryById($args)
  {
    $id = $args['id'];
    $summary = $this->summaryDao->getById($id);
    $summary['generated_text'] = "Здравстуйте, ваше резюме нас заинтресовало, пожалуйста, пройдите тестовое задание.";
    $summary['task'] = [['id_task' => '1', 'file_url' =>
      "http://hr-gazprombank.creativityprojectcenter.ru/files/tasks/88ade9108ad923507a0f308dc3859a82.docx",
      'date_upload' => "1606595160"]];
    $summary['vacancy'] = $this->summaryVacancyDao->getLinks($id);
    return $summary;
  }

  public function getSummaryList($args)
  {
    $offset = $args['offset'];
    $filter = $args['filter'];
    $status = $args['status'];
    $list = $this->summaryDao->getList($offset, $filter, $status);
    foreach ($list['data'] as &$val) {
      $val['vacancy'] = $this->summaryVacancyDao->getLinks($val['id'], $filter);
    }
    return $list;
  }

  public function getVacancyList($args)
  {
    $offset = $args['offset'];
    $arr = $this->vacancy->getListVacancy($offset);
//        foreach ($arr as &$vacancy){
//            $this->getVacancy($vacancy);
//        }
    return $arr;
  }

  public function getVacancyById($args)
  {
    $id = $args['id'];
    $vacancy = $this->vacancy->getById($id);
    $this->getVacancy($vacancy);
    return $vacancy;
  }

  private function getVacancy(&$vacancy)
  {
    $duties = $this->dutiesVacancy->getDutiesByVacancy($vacancy['id']);
    foreach ($duties as &$val) {
      $val['keywords'] = $this->dutiesKeywordDao->getDutiesBySkills($val['id']);
    }
    $vacancy['duties'] = $duties;

    $skills = $this->skillVacancy->getSkillsByVacancy($vacancy['id']);
    foreach ($skills as &$skill) {
      $skill['keywords'] = $this->skillKeywordDao->getKeywordBySkills($skill['id']);
    }
    $vacancy['skills'] = $skills;

    $vacancy['suggest'] = $this->suggestVacancyDao->getSuggestByVacancy($vacancy['id']);

    $vacancy['task'] = $this->fileVacancyDao->getFilesByVacancy($vacancy['id']);
  }

  public function createVacancy($args)
  {

    $title = $args['title'];
    $work_start = $args['work_start'];
    $word_end = $args['work_end'];
    $region = $args['region_id'];
    $is_distant = $args['is_distant'];
    $description = $args['description'];
    $duties = $args['duties'];
    $skills = $args['skills'];
    $suggest = $args['suggest'];

    $id_vacancy = $this->vacancy->createVacancy($title, $work_start, $word_end, $region, $is_distant, $description);

    foreach ($skills as $skill) {
      $id_skill = $this->skillDao->createSkill($skill['text']);
      if ($id_skill != -1) {
        $this->skillVacancy->createSkillVacancy($id_vacancy, $id_skill);
        if (isset($skill['keyword'])) {
          $this->skillKeywordDao->createSkillKeyword($id_skill, $skill['keyword']);
        }
      } else {
        print_r("error");
        return ['code' => '1'];
      }
    }

    foreach ($duties as $duty) {
      $id_duty = $this->skillDao->createSkill($duty['text']);
      if ($id_duty != -1) {
        $this->dutiesVacancy->createDutiesVacancy($id_vacancy, $id_duty);
        if (isset($duty['keyword'])) {
          $this->dutiesKeywordDao->createDutiesKeyword($id_duty, $duty['keyword']);
        }
      } else {
        print_r("error");
        return ['code' => '1'];
      }
    }

    foreach ($suggest as $value) {
      $id_suggest = $this->skillDao->createSkill($value['text']);
      if ($id_suggest != -1) {
        $this->suggestVacancyDao->createSuggestVacancy($id_vacancy, $id_suggest);
      } else {
        print_r("error");
        return ['code' => '1'];
      }
    }

    return ['code' => 0, 'id' => $id_vacancy];

  }

  public function getAutoAnswers()
  {
    return $this->autoAnswerDao->getList();
  }

  public function sendTest($args){
    $id_summary = $args['id'];
    return ['code'=>$this->summaryDao->changeStatus($id_summary, 1)];
  }

  public function applyTest($args)
  {
    $id_summary = $args['id'];
    return ['code'=>$this->summaryDao->changeStatus($id_summary, 2)];
  }

  public function denyTest($args){
    $id_summary = $args['id'];
    return ['code'=>$this->summaryDao->changeStatus($id_summary, 3)];
  }

  public function applyUser($args){
    $id_summary = $args['id'];
    return ['code'=>$this->summaryDao->changeStatus($id_summary, 4)];
  }

  public function denyUser($args){
    $id_summary = $args['id'];
    return ['code'=>$this->summaryDao->changeStatus($id_summary, 5)];
  }

}
