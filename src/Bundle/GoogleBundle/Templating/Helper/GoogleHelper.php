<?php

declare(strict_types=1);

namespace Bundle\GoogleBundle\Templating\Helper;

use Component\Google\Definition\Action;
use Component\Google\Definition\Field;
use Component\Google\Definition\Filter;
use Component\Google\Renderer\GoogleRendererInterface;
use Component\Google\View\GoogleView;
use Bundle\CoreBundle\Services\Button;
use Symfony\Component\Templating\Helper\Helper;
use Bundle\GoogleBundle\Entity\GoogleDriveFile;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class GoogleHelper extends Helper
{
    /**
     * @var GoogleRendererInterface
     */
    private $googleRenderer;

    private $router;

    /**
     * @param GoogleRendererInterface $googleRenderer
     */
    public function __construct(GoogleRendererInterface $googleRenderer, Router $router)
    {
        $this->googleRenderer = $googleRenderer;
        $this->router = $router;
    }

    //        JAFETH
    public function googleDescription(string $description = null)
    {
        return is_null($description) ? '-' : nl2br($description);
    }

    //    JAFETH
    public function googleWatchViewer($fileId, $fileMimeType)
    {

        $fileMimeTypeViewer = isset(GoogleDriveFile::MIME_TYPES_VIEWER[$fileMimeType]) ? GoogleDriveFile::MIME_TYPES_VIEWER[$fileMimeType] : 'exception-no-mime-type';


//        echo "POLLO::fileMimeTypeViewer:: <pre>";
//        print_r($fileMimeTypeViewer);
//        exit;



        switch ($fileMimeTypeViewer) {
            case 'image';
                $template = '@GoogleBundle/Resources/views/GoogleDriveFileGrid/Watch/ViewersTemplate/image.html.twig';
            break;
            case 'google_viewer';
                $template = '@GoogleBundle/Resources/views/GoogleDriveFileGrid/Watch/ViewersTemplate/google_viewer.html.twig';
            break;
            case 'folder';
                $template = '@GoogleBundle/Resources/views/GoogleDriveFileGrid/Watch/ViewersTemplate/folder.html.twig';
            break;
            case 'video';
                $template = '@GoogleBundle/Resources/views/GoogleDriveFileGrid/Watch/ViewersTemplate/video.html.twig';
            break;
            case 'code';
                $template = '@GoogleBundle/Resources/views/GoogleDriveFileGrid/Watch/ViewersTemplate/code.html.twig';
            break;
            case 'zip';
                $template = '@GoogleBundle/Resources/views/GoogleDriveFileGrid/Watch/ViewersTemplate/zip.html.twig';
            break;
            default:
                $template = '@GoogleBundle/Resources/views/GoogleDriveFileGrid/Watch/ViewersTemplate/default.html.twig';
//                $template = '';
        }

        return $this->googleRenderer->renderViewer($fileId, $template);
    }

    public function googleSpanClass($fileMimeType)
    {

        if ($fileMimeType == GoogleDriveFile::GOOGLE_FOLDER) {
            return 'x-hand';
        }

        return;
    }

    public function googleMimeTypeIcon($mimeType)
    {
        $class = isset(GoogleDriveFile::MIME_TYPES[$mimeType]) ? GoogleDriveFile::MIME_TYPES[$mimeType] : 'file';

        return '<i class="fa fa-2x fa-fw fa-' . $class . '"></i>';
    }

    public function googleSpanUrlFilter($value, $field)
    {
        if (isset($value['mimeType']) && ($value['mimeType'] == GoogleDriveFile::GOOGLE_FOLDER)) {

            return $this->router->generate(
                'backend_google_drive_index',
                [
                    'field' => $field,
                    'parents' => $value['id'],
                    'folder_name' => $value['name']
                ]
            );
        }

        return 'javascript:void(0)';
    }

    public function base64Encode($str)
    {
        return base64_encode($str);
    }

    public function googleFileValues($value)
    {
//        $value = array_replace([
//            'id' => '',
//            'name' => '',
//            'iconLink' => '',
//            'mimeType' => '',
//            'size' => '',
//        ], $value);


        $value = [
            isset($value['id']) ? $value['id'] : '',
            isset($value['name']) ? $value['name'] : '',
            isset($value['iconLink']) ? $value['iconLink'] : '',
            isset($value['mimeType']) ? $value['mimeType'] : '',
            $this->formatBytesFilter($value['size']),
        ];

        return base64_encode(json_encode($value));
    }

    private function formatBytesFilter($bytes, $precision = 2)
    {

        if(empty($bytes)){
            return;
        }

        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

        $power = $bytes > 0 ? floor(log(floatval($bytes), 1024)) : 0;

        return number_format($bytes / pow(1024, $power), $precision, '.', ',') . ' ' . $units[$power];
    }
    //    JAFETH

        /**
     * @param GoogleView $gridView
     * @param string|null $template
     *
     * @return mixed
     */
    public function renderGoogle(GoogleView $gridView, string $template = null)
    {
        //JAFETH
        return $this->googleRenderer->render($gridView, $template);
    }

    /**
     * @param GoogleView $gridView
     * @param Field $field
     * @param mixed $data
     *
     * @return mixed
     */
    public function renderField(GoogleView $gridView, Field $field, $data)
    {
        return $this->googleRenderer->renderField($gridView, $field, $data);
    }

    /**
     * @param GoogleView $gridView
     * @param Action $action
     * @param mixed|null $data
     *
     * @return mixed
     */
    public function renderAction(GoogleView $gridView, Action $action, $data = null)
    {
        return $this->googleRenderer->renderAction($gridView, $action, $data);
    }

    /**
     * @param GoogleView $gridView
     * @param Filter $filter
     *
     * @return mixed
     */
    public function renderFilter(GoogleView $gridView, Filter $filter)
    {
        return $this->googleRenderer->renderFilter($gridView, $filter);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'sylius_grid';
    }
}
