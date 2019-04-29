<?php

declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use BureauPartners\pdfgrep\pdfgrep;

final class ExtractPdfTest extends TestCase
{
    public function testCanExtractWord()
    {
        $pdfgrep = new pdfgrep('/var/www/html/tests/pdf/Document.pdf', 'id');
        $this->assertCount(7, $pdfgrep->getMatches());
    }

    public function testCanGetPageNumbers()
    {
        $pdfgrep = new pdfgrep('/var/www/html/tests/pdf/Document.pdf', 'id');
        $this->assertCount(1, $pdfgrep->getPageNumbers());
    }
}
