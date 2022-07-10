<?php
/**
 * Created by PhpStorm.
 * User: ridwan
 * Date: 25/11/2018
 * Time: 19:33
 */

namespace App\Routing\Route;
use Cake\ORM\Locator\TableLocator;
use Cake\Routing\Route\Route;
use Psr\Http\Message\ServerRequestInterface;

class PageRoute extends Route
{
    /**
     * @param ServerRequestInterface $request
     * @return array|bool|false
     */
    public function parseRequest(ServerRequestInterface $request)
    {

        $params = parent::parseRequest($request);

        if(is_bool($params)) {
            return false;
        }

        $pageTable = (new TableLocator())->get('AdminPanel.Pages');
        $page = $pageTable->find()
            ->select(['Pages.slug'])
            ->contain(['Pages_title_translation', 'Pages_content_translation', 'I18n'])
            ->where([
                'slug' => $params['slug'],
                'enable' => 1
            ])

            ->first();

        if (!$page) {
            return false;
        }


        return $params;
    }
}
