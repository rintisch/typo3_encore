<?php

declare(strict_types=1);

/*
 * This file is part of the "typo3_encore" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Ssch\Typo3Encore\Tests\Unit\ViewHelpers;

use PHPUnit\Framework\MockObject\MockObject;
use Prophecy\PhpUnit\ProphecyTrait;
use Ssch\Typo3Encore\Asset\EntrypointLookupInterface;
use Ssch\Typo3Encore\Asset\TagRendererInterface;
use Ssch\Typo3Encore\ValueObject\ScriptTag;
use Ssch\Typo3Encore\ViewHelpers\RenderWebpackScriptTagsViewHelper;

final class RenderWebpackScriptTagsViewHelperTest extends ViewHelperBaseTestcase
{
    use ProphecyTrait;

    protected RenderWebpackScriptTagsViewHelper $viewHelper;

    /**
     * @var TagRendererInterface|MockObject
     */
    protected $tagRenderer;

    protected function setUp(): void
    {
        parent::setUp();
        $this->tagRenderer = $this->getMockBuilder(TagRendererInterface::class)->getMock();
        $this->viewHelper = new RenderWebpackScriptTagsViewHelper($this->tagRenderer);
    }

    public function testRender(): void
    {
        $this->setArgumentsUnderTest($this->viewHelper, [
            'entryName' => 'app',
            'position' => 'footer',
            'buildName' => EntrypointLookupInterface::DEFAULT_BUILD,
            'parameters' => [],
            'registerFile' => true,
        ]);
        $scriptTag = new ScriptTag('app', 'footer', EntrypointLookupInterface::DEFAULT_BUILD);
        $this->tagRenderer->expects(self::once())->method('renderWebpackScriptTags')->with($scriptTag);
        $this->viewHelper->initializeArgumentsAndRender();
    }
}
