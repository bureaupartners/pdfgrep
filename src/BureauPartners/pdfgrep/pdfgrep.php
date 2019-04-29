<?php

namespace BureauPartners\pdfgrep;

class pdfgrep
{
    protected $command = 'pdfgrep -n';
    protected $filename = null;
    protected $matches = [];

    public function __construct($filename, $pattern)
    {
        $this->filename = $filename;

        return $this->execute($pattern);
    }

    private function processOutput($output)
    {
        foreach ($output as $match) {
            //list($pageno, $sentence) =
            $data = preg_match('/^([0-9]*):(.*)/s', $match, $matches);
            $this->matches[] = [
                'page' => $matches[1],
                'sentence' => $matches[2],
            ];
        }
    }

    private function execute($pattern, $options = null)
    {
        exec($this->command.' '.$options.' "'.$pattern.'" '.$this->filename, $output, $exit_code);
        switch ($exit_code) {
            case 0:
                // matches found
                $this->processOutput($output);

                return true;
                break;
            case 2:
                // error
                return false;
                break;
            default:
                return false;
                break;
        }
    }

    public function getMatches()
    {
        return $this->matches;
    }

    public function getPageNumbers()
    {
        $key = 'page';

        return array_unique(array_map(function ($item) use ($key) {
            return $item[$key];
        }, $this->matches));
    }
}
