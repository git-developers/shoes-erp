<?php

namespace Bundle\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Bundle\CoreBundle\Command\TruncateTablesCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Webmozart\Assert\Assert;


class DefaultController extends BaseController
{

    public function loadFixturesAction(Request $request): Response
    {

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_Administrator')) {
            return $this->redirectToRoute('frontend_default_index');
        }

        if ($request->isMethod('POST')) {

            //truncate tables
            $command = new TruncateTablesCommand();
            $command->setContainer($this->container);
            $input = new ArrayInput(['status' => true]);
            $output = new BufferedOutput();
            $resultCode = $command->run($input, $output);
            //truncate tables


            //load fixtures
            $application = new Application($this->get('kernel'));
            $application->setAutoExit(false);

            $input = new ArrayInput(array(
                'command' => 'doctrine:fixtures:load',
            ));

            // You can use NullOutput() if you don't need the output
            $output = new BufferedOutput();
            $application->run($input, $output);

            // return the output, don't use if you used NullOutput()
            $content = $output->fetch();
            //load fixtures

            return $this->json([
                'content' => $content,
            ]);
        }

        $options = $request->attributes->get('_tianos');

        $template = $options['template'] ?? null;
        Assert::notNull($template, 'Template is not configured.');

        return $this->render(
            $template,
            [
                'value' => null,
            ]
        );
    }
}
