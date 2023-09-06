<?php

namespace App\Utils\Faker;

use Faker\Provider\Base;

class MarkdownProvider extends Base
{
    public function simpleMarkdown(): string
    {
        return str(sprintf(<<<MARKDOWN
## %s

<p>%s</p>
%s

### %s

<p>%s</p>
MARKDOWN, 
            $this->generator->sentence(5),
            $this->generator->paragraph(4),
            $this->generator->paragraph(2),
            $this->generator->sentence(5),
            $this->generator->paragraph(4),
        ))->replace('/^[\t ]+/m', '');
    }

    public function markdownWithImage(): string
    {
        return sprintf(<<<MARKDOWN
## %s

<p>%s</p>
[](%s)

### %s

<p>%s</p>
MARKDOWN, 
            $this->generator->sentence(5),
            $this->generator->paragraph(4),
            $this->generator->imageUrl(1280, 720, 'technology', gray: true),
            $this->generator->sentence(5),
            $this->generator->paragraph(4),
        );
    }

    public function markdownWithTable(): string
    {
        return '';
    }

    public function fullMarkdown(): string
    {
        return '';
    }
}
