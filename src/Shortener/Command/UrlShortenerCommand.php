<?php
namespace App\Shortener\Command;

use App\Shortener\Services\UrlEncoder;
use App\Shortener\Services\UrlDecoder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UrlShortenerCommand extends Command
{
    protected static $defaultName = 'app:url-shortener';

    private UrlEncoder $encoder;
    private UrlDecoder $decoder;

    public function __construct(UrlEncoder $encoder, UrlDecoder $decoder)
    {
        parent::__construct();
        $this->encoder = $encoder;
        $this->decoder = $decoder;
    }

    protected function configure()
    {
        $this
            ->setDescription('Encode or decode URLs')
            ->addArgument('action', InputArgument::REQUIRED, 'encode|decode')
            ->addArgument('value', InputArgument::REQUIRED, 'URL or code');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $action = $input->getArgument('action');
        $value = $input->getArgument('value');

        if ($action === 'encode') {
            $code = $this->encoder->encode($value);
            $output->writeln("Encoded: $code");
        } elseif ($action === 'decode') {
            $url = $this->decoder->decode($value);
            $output->writeln("Decoded: $url");
        } else {
            $output->writeln("Unknown action: $action");
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}