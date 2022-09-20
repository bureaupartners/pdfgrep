<?php
/*
 * @author Mark Hameetman (BureauPartners B.V.) <mark@bureau.partners>
 * @link https://github.com/bureaupartners/pdfgrep
 * @license MIT
 *
 * @copyright Copyright (c) 2019, GRIVOS Holding B.V.
 */

namespace BureauPartners\pdfgrep;

class pdfgrep
{
    protected $command  = 'pdfgrep -n -P';
    protected $filename = null;
    protected $matches  = [];

    public function __construct($filename, $pattern)
    {
        $this->filename = $filename;

        return $this->execute($pattern);
    }

    private function processOutput($output, $pattern)
    {
        foreach ($output as $match) {
            //list($pageno, $sentence) =
            $data = preg_match('/^([0-9]*):(.*)/s', $match, $matches);
            // because pdfgrep returns complete sentence, extract match
            $exact_match = preg_match('/' . $pattern . '/s', $matches[2], $exact_matches);
            if (count($matches) > 0) {
                $this->matches[] = [
                    'page'        => $matches[1],
                    'sentence'    => $matches[2],
                    'exact_match' => reset($exact_matches),
                ];
            }
        }
    }

    private function execute($pattern, $options = null)
    {
        exec($this->command ' --cache ' . ' ' . $options . ' "' . $pattern . '" ' . $this->filename, $output, $exit_code);
        switch ($exit_code) {
            case 0:
                // matches found
                $this->processOutput($output, $pattern);

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

    public function getFirstMatch()
    {
        return reset($this->matches);
    }

    public function getPageNumbers()
    {
        $key = 'page';

        return array_unique(array_map(function ($item) use ($key) {
            return $item[$key];
        }, $this->matches));
    }
}
