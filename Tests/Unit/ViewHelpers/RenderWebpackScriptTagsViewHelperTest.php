<?php

namespace Ssch\Typo3Encore\Tests\Unit\ViewHelpers;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use Nimut\TestingFramework\TestCase\ViewHelperBaseTestcase;
use Ssch\Typo3Encore\Asset\TagRendererInterface;
use Ssch\Typo3Encore\ViewHelpers\RenderWebpackScriptTagsViewHelper;

class RenderWebpackScriptTagsViewHelperTest extends ViewHelperBaseTestcase
{
    /**
     * @var MockObject|RenderWebpackScriptTagsViewHelper
     */
    protected $viewHelper;

    /**
     * @var TagRendererInterface
     */
    protected $tagRenderer;

    protected function setUp()
    {
        parent::setUp();
        $this->tagRenderer = $this->getMockBuilder(TagRendererInterface::class)->getMock();
        $this->viewHelper = new RenderWebpackScriptTagsViewHelper($this->tagRenderer);
    }

    /**
     * @test
     */
    public function render()
    {
        $this->viewHelper->setArguments(['entryName' => 'app', 'position' => 'footer', 'buildName' => '_default']);
        $this->tagRenderer->expects($this->once())->method('renderWebpackScriptTags')->with('app', 'footer', '_default');
        $this->viewHelper->render();
    }
}
