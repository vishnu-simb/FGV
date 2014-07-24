<?php

/**
 * Author: trac.nguyen (npbtrac@yahoo.com)
 * Date: 7/4/14
 * Time: 5:53 PM
 *
 * console class for crawling from database
 */
class TournamentSoftwareApiCommand extends SimbConsoleCommand
{
    /**
     * Get a web file (HTML, XHTML, XML, image, etc.) from a URL.  Return an
     * array containing the HTTP server response header fields and content.
     */
    function get_web_page($url)
    {
        $options = array(
            CURLOPT_USERPWD => "tsapi_bwf_olivier_caillet:KL6h875fr2H",
            CURLOPT_RETURNTRANSFER => true, // return web page
            CURLOPT_HEADER => false, // don't return headers
            CURLOPT_FOLLOWLOCATION => true, // follow redirects
            CURLOPT_ENCODING => "", // handle all encodings
            CURLOPT_USERAGENT => "spider", // who am i
            CURLOPT_AUTOREFERER => true, // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120, // timeout on connect
            CURLOPT_TIMEOUT => 120, // timeout on response
            CURLOPT_MAXREDIRS => 10, // stop after 10 redirects
            CURLOPT_SSL_VERIFYPEER => false // Disabled SSL Cert checks
        );

        $ch = curl_init($url);
        curl_setopt_array($ch, $options);
        $content = curl_exec($ch);
        $err = curl_errno($ch);
        $errmsg = curl_error($ch);
        $header = curl_getinfo($ch);
        curl_close($ch);

        $header['errno'] = $err;
        $header['errmsg'] = $errmsg;
        $header['content'] = $content;
        return $header;
    }

    /**
     * Crawl all data
     */
    public function actionCrawlAll()
    {
        $this->actionCrawlOrganization();
        $this->actionCrawlOrganizationPerson();
        $this->actionCrawlTournament();
    }

    /**
     * Command console actions for crawling organizations and related data
     */
    public function actionCrawlOrganization()
    {
        echo "Fetching organizations: .... \n";
        /* @var $modelOrganization Organization */
        $modelOrganization = new Organization();
        $modelOrganization->getDataFromApi();

        echo "Fetching organization levels: .... \n";
        $rowsOrganization = Organization::model()->findAll('is_deleted = :is_deleted', array(':is_deleted' => 0));
        foreach ($rowsOrganization as $modelOrganization) {
            $modelOrganization->getLevelsFromApi();
        }
        unset($rowsOrganization);

        echo "Fetching organization memberships: .... \n";
        $rowsOrganization = Organization::model()->findAll('is_deleted = :is_deleted', array(':is_deleted' => 0));
        foreach ($rowsOrganization as $modelOrganization) {
            $modelOrganization->getMembershipsFromApi();
        }
        unset($rowsOrganization);

        echo "Fetching organization categories: .... \n";
        $rowsOrganization = Organization::model()->findAll('is_deleted = :is_deleted', array(':is_deleted' => 0));
        foreach ($rowsOrganization as $modelOrganization) {
            $modelOrganization->getCategoriesFromApi();
        }
        unset($rowsOrganization);

        echo "Fetching organization roles: .... \n";
        $rowsOrganization = Organization::model()->findAll('is_deleted = :is_deleted', array(':is_deleted' => 0));
        foreach ($rowsOrganization as $modelOrganization) {
            $modelOrganization->getRolesFromApi();
        }
        unset($rowsOrganization);

        echo "Fetching organization groups: .... \n";
        $rowsOrganization = Organization::model()->findAll('is_deleted = :is_deleted', array(':is_deleted' => 0));
        foreach ($rowsOrganization as $modelOrganization) {
            $modelOrganization->getGroupsFromApi();
        }
        unset($rowsOrganization);
    }

    public function actionCrawlOrganizationPerson()
    {
        echo "Fetching organization persons: .... \n";
        /* @var $modelOrganizationGroup OrganizationGroup */
        $rowsOrganizationGroup = OrganizationGroup::model()->findAll(
            'is_deleted = :is_deleted',
            array(':is_deleted' => 0)
        );
        foreach ($rowsOrganizationGroup as $modelOrganizationGroup) {
            $modelOrganizationGroup->getPersonsFromApi();
        }
        unset($modelOrganizationGroup);
    }

    /**
     * Crawl alll details of people in database
     * @param int $pageno
     */
    public function actionCrawlOrganizationPersonDetails($pageno = 0)
    {
        /* @var $modelOrganization Organization */
        echo "Fetching organization person details: .... \n";

        $pageno = intval($pageno);
        if ($pageno < 0) {
            $pageno = 0;
        }
        $criteria = new CDbCriteria();
        $criteria->limit = 30;
        $criteria->offset = $pageno * 30;
        $criteria->condition = 'is_deleted = :is_deleted';
        $criteria->params = array(':is_deleted' => 0);
        $rowsOrganization = Organization::model()->findAll($criteria);
        if ($rowsOrganization) {
            foreach ($rowsOrganization as $modelOrganization) {
                OrganizationPerson::crawlDetails($modelOrganization->code);
            }
            unset($rowsOrganization);
        } else {
            $this->actionCrawlOrganizationPersonDetails($pageno + 1);
        }
    }

    /**
     * Crawl all the data of Tournaments
     */
    public function actionCrawlTournament()
    {
        echo "Fetching Tournament Categories: .... \n";
        TournamentCategory::getAllFromApi();

        echo "Fetching Tournaments by Tournament Categories: .... \n";
        $criteria = new CDbCriteria();
        $criteria->limit = 100;
        $criteria->offset = 0;
        $criteria->condition = 'is_deleted = :is_deleted';
        $criteria->params = array(':is_deleted' => 0);

        /* @var $rowsTournamentCategory TournamentCategory[] */
        $rowsTournamentCategory = TournamentCategory::model()->findAll($criteria);
        if ($rowsTournamentCategory) {
            foreach ($rowsTournamentCategory as $modelTournamentCategory) {
                $modelTournamentCategory->addTournamentFromApi();
            }
            unset($rowsTournamentCategory);
        }
    }

    /**
     * Crawl all ranking categories and publications
     */
    public function actionCrawlRanking()
    {
        echo "Fetching Rankings: .... \n";
        Ranking::getAllFromApi();

        echo "Fetching Ranking Categories by Rankings: .... \n";
        $criteria = new CDbCriteria();
        $criteria->limit = 100;
        $criteria->offset = 0;
        $criteria->condition = 'is_deleted = :is_deleted';
        $criteria->params = array(':is_deleted' => 0);

        /* @var $rowsRanking Ranking[] */
        $rowsRanking = Ranking::model()->findAll($criteria);
        if ($rowsRanking) {
            foreach ($rowsRanking as $modelRanking) {
                $modelRanking->addCategoryFromApi();
                $modelRanking->addPublicationFromApi();
            }
            unset($rowsRanking);
        }
    }

    public function actionCrawlRankingDetails($limitPublication = 0)
    {
        echo "Fetching Ranking Details: .... \n";
        $criteria = new CDbCriteria();
        $criteria->limit = 100;
        $criteria->offset = 0;
        $criteria->condition = 'is_deleted = :is_deleted';
        $criteria->params = array(':is_deleted' => 0);

        /* @var $rowsRanking Ranking[] */
        $rowsRanking = Ranking::model()->findAll($criteria);
        if ($rowsRanking) {
            foreach ($rowsRanking as $modelRanking) {
                RankingPublication::getRankingDetailsFromApi($modelRanking->id, $modelRanking->code, $limitPublication);
            }
            unset($rowsRanking);
        }
    }

    public function actionTestNonPlayer()
    {
        $apiXml = new TournamentSoftwareAPI();
        $response = $apiXml->getContent(
            'Organization/209B123F-AA87-41A2-BC3E-CB57133E64CC/Group/77764448-8238-4076-BB7A-5431D8AA513A/Membership/RoleType/1'
        );

        $objXml = simplexml_load_string($response);
        $arrPlayer = $objXml->children();


        $apiXml = new TournamentSoftwareAPI();
        $response = $apiXml->getContent(
            'Organization/209B123F-AA87-41A2-BC3E-CB57133E64CC/Group/77764448-8238-4076-BB7A-5431D8AA513A/Person?pagesize=1000&pageno=1'
        );

        $objXml = simplexml_load_string($response);
        $arrPerson = $objXml->children();


        $arrCode = array();
        foreach ($arrPerson as $key => $value) {
            $code = $value->Code->__toString();
            $ok = true;
            foreach ($arrPlayer as $player) {
                if ($code == $player->Code->__toString()) {
                    $ok = false;
                }
            }
            if ($ok) {
                $arrCode[] = $value;
            }
        }
        print_r($arrCode);
    }
}