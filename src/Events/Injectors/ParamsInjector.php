<?php

namespace App\Events\Injectors;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Contracts\Translation\TranslatorInterface;

class ParamsInjector
{
    /**ParamsInjector
     * @var TranslatorInterface
     */
    private TranslatorInterface $translator;
    /**
     * @var mixed
     */
    private mixed $route;

    public function __construct(TranslatorInterface $translator, RequestStack $requestStack)
    {
        $this->translator = $translator;

        $this->route = $requestStack->getCurrentRequest()->get('_route');
    }

    public function params(): array
    {

        $pageTitle = $this->transformPageKey($this->route);
        $sectionTitle = $this->transformTitleKey($this->route);

        return $this->getPageContent($pageTitle, $sectionTitle);

    }

    public function getPageContent($pageTitle, $sectionTitle): array
    {
        if ($this->transformTitleKey($this->route) == 'Client'){
            return [
                'page_title' => $this->translator->trans('link-page-' . str_replace('_', '-', strtolower($pageTitle))),
                'page_section' => $this->translator->trans('section-' . str_replace('_', '-', strtolower($sectionTitle))),
                'page_icon' => $this->favIcon(),
                'index_url' => 'app_'.strtolower($pageTitle).'_index',
                'new_url' => 'app_'.strtolower($pageTitle).'_new',
                'edit_url' => 'app_'.strtolower($pageTitle).'_edit',
                'show_url' => 'app_'.strtolower($pageTitle).'_show',
                'delete_url' => 'app_'.strtolower($pageTitle).'_delete',
                'url_path' => 'client/'.str_replace('_', '/', strtolower($pageTitle)).'/',
            ];
        }elseif ($this->transformTitleKey($this->route) == 'Security'){
            return [
                'page_title' => $this->translator->trans('link-page-' . str_replace('_', '-', strtolower($pageTitle))),
                'page_section' => $this->translator->trans('section-' . str_replace('_', '-', strtolower($sectionTitle))),
                'page_icon' => $this->favIcon(),
            ];
        }elseif ($this->transformTitleKey($this->route) == 'Main'){
            return [
                'page_title' => $this->translator->trans('link-page-' . str_replace('_', '-', strtolower($pageTitle))),
                'page_section' => $this->translator->trans('section-' . str_replace('_', '-', strtolower($this->transformSectionKey($pageTitle)))),
                'page_icon' => $this->favIcon(),
                'index_url' => 'app_'.strtolower($pageTitle).'_index',
                'new_url' => 'app_'.strtolower($pageTitle).'_new',
                'edit_url' => 'app_'.strtolower($pageTitle).'_edit',
                'show_url' => 'app_'.strtolower($pageTitle).'_show',
                'delete_url' => 'app_'.strtolower($pageTitle).'_delete',
                'url_path' => 'admin/'.str_replace('_', '/', strtolower($pageTitle)).'/',

            ];
        }elseif ($this->transformTitleKey($this->route) == 'Services'){
            return [
                'page_title' => $this->translator->trans('link-page-' . str_replace('_', '-', strtolower($pageTitle))),
                'page_section' => $this->translator->trans('section-' . str_replace('_', '-', strtolower($this->transformSectionKey($pageTitle)))),
                'page_icon' => $this->favIcon(),
                'index_url' => 'app_' . strtolower($pageTitle) . '_index',
                'new_url' => 'app_' . strtolower($pageTitle) . '_new',
                'edit_url' => 'app_' . strtolower($pageTitle) . '_edit',
                'show_url' => 'app_' . strtolower($pageTitle) . '_show',
                'url_path' => 'services/' . str_replace('_', '/', strtolower($pageTitle)) . '/',
            ];
        }elseif ($this->transformTitleKey($this->route) == 'Module'){
            return [
                'page_title' => $this->translator->trans('link-page-' . str_replace('_', '-', strtolower($pageTitle))),
                'page_section' => $this->translator->trans('section-' . str_replace('_', '-', strtolower($this->transformSectionKey($pageTitle)))),
                'page_icon' => $this->favIcon(),
                'index_url' => 'app_' . strtolower($pageTitle) . '_index',
                'new_url' => 'app_' . strtolower($pageTitle) . '_new',
                'edit_url' => 'app_' . strtolower($pageTitle) . '_edit',
                'show_url' => 'app_' . strtolower($pageTitle) . '_show',
                'url_path' => 'module/' . str_replace('_', '/', strtolower($pageTitle)) . '/',
            ];
        }else{
            return [
                'page_title' => $this->translator->trans('link-page-' . str_replace('_', '-', strtolower($pageTitle))),
                'page_section' => $this->translator->trans('section-' . str_replace('_', '-', strtolower($sectionTitle))),
                'page_icon' => $this->favIcon(),
            ];
        }
    }

    public function urlPath(): string
    {
        if ($this->transformTitleKey($this->route) == $this->transformPageKey($this->route) or (str_contains($this->route, 'security'))){
            $str = $this->transformPageKey($this->route);
        }else {
            $path = $this->transformPageKey($this->route);
            $str = preg_replace('/^App_/', '', $path);
        }

        return ''.str_replace('_', '/', strtolower($str)).'/';

    }

    public function transformTitleKey($key): string
    {
        $array = explode("_", $key);
        //if($array[0]) array_shift($array);
        //$string = implode(" ", $array);
        return ucwords($array[1]);
    }

    public function transformSectionKey($key): string
    {
        $array = explode("_", $key);
        //if($array[0]) array_shift($array);
        //$string = implode(" ", $array);
        if (array_key_exists(9, $array)) {
            $string = $array[0].'_'.$array[1].'_'.$array[2].'_'.$array[3].'_'.$array[4].'_'.$array[5].'_'.$array[6].'_'.$array[7];
        }elseif (array_key_exists(7, $array)) {
            $string = $array[0].'_'.$array[1].'_'.$array[2].'_'.$array[3].'_'.$array[4].'_'.$array[5].'_'.$array[6];
        }elseif (array_key_exists(6, $array)) {
            $string = $array[0].'_'.$array[1].'_'.$array[2].'_'.$array[3].'_'.$array[4].'_'.$array[5];
        }elseif (array_key_exists(5, $array)) {
            $string = $array[0].'_'.$array[1].'_'.$array[2].'_'.$array[3].'_'.$array[4];
        }elseif  (array_key_exists(4, $array)) {
            $string = $array[0].'_'.$array[1].'_'.$array[2].'_'.$array[3];
        }elseif  (array_key_exists(3, $array)) {
            $string = $array[0].'_'.$array[1].'_'.$array[2];
        }elseif (array_key_exists(2, $array)) {
            $string = $array[0].'_'.$array[1];
        }else{
            $string = $array[0];
        }

        return ucwords($string);
    }

    public function transformPageKey($key): string
    {
        $array = explode("_", $key);
        //if($array[0]) array_shift($array);
        //$string = implode(" ", $array);
        if (array_key_exists(8, $array)) {
            $string = $array[1].'_'.$array[2].'_'.$array[3].'_'.$array[4].'_'.$array[5].'_'.$array[6].'_'.$array[7];
        }elseif (array_key_exists(7, $array)) {
            $string = $array[1].'_'.$array[2].'_'.$array[3].'_'.$array[4].'_'.$array[5].'_'.$array[6];
        }elseif (array_key_exists(6, $array)) {
            $string = $array[1].'_'.$array[2].'_'.$array[3].'_'.$array[4].'_'.$array[5];
        }elseif (array_key_exists(5, $array)) {
            $string = $array[1].'_'.$array[2].'_'.$array[3].'_'.$array[4];
        }elseif  (array_key_exists(4, $array)) {
            $string = $array[1].'_'.$array[2].'_'.$array[3];
        }elseif  (array_key_exists(3, $array)) {
            $string = $array[1].'_'.$array[2];
        }elseif (array_key_exists(2, $array)) {
            $string = $array[1];
        }else{
            $string = $array[0];
        }

        return ucwords($string);
    }

    public function favIcon(): string
    {
        $iconVar = 'bx bx-fw fs-5';
        $iconName = 'bxs-dashboard';

        if (str_contains($this->route, 'blogs')) {
            $iconName = 'bx-edit';
        }elseif (str_contains($this->route, 'environ')) {
            $iconName = 'bx-globe-alt';
        }elseif (str_contains($this->route, 'locations')) {
            $iconName = 'bx-map-pin';
        }elseif (str_contains($this->route, 'filters')) {
            $iconName = 'bx-filter-alt';
        }elseif (str_contains($this->route, 'knowledge')) {
            $iconName = 'bx-edit';
        }elseif (str_contains($this->route, 'mailbox')) {
            $iconName = 'bx-envelope';
        }elseif (str_contains($this->route, 'news')) {
            $iconName = 'bx-news';
        }elseif (str_contains($this->route, 'messaging')) {
            $iconName = 'bx-message-rounded-dots';
        }elseif (str_contains($this->route, 'recruitment')) {
            $iconName = 'bx-buildings';
        }elseif (str_contains($this->route, 'shopping')) {
            $iconName = 'bx-cart';
        }elseif (str_contains($this->route, 'support')) {
            $iconName = 'bx-buoy';
        }elseif (str_contains($this->route, 'translation')) {
            $iconName = 'bx-cabinet';
        }elseif (str_contains($this->route, 'profiles')) {
            $iconName = 'bx-user';
        }elseif (str_contains($this->route, 'users')) {
            $iconName = 'bxs-user-account';
        }elseif (str_contains($this->route, 'security')) {
            $iconName = 'bx-shield-alt';
        }elseif (str_contains($this->route, 'clientele')) {
            $iconName = 'bx-book-content';
        }elseif (str_contains($this->route, 'module')) {
            $iconName = 'bx-intersect';
        }elseif (str_contains($this->route, 'services')) {
            $iconName = 'bx-intersect';
        }

        return $iconVar.' '.$iconName;
    }
}