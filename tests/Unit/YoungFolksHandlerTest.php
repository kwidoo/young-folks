<?php

namespace Tests\Unit;

use App\Http\Webhooks\YoungFolksHandler;
use App\Models\MenuItem;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Models\TelegraphBot;
use DefStudio\Telegraph\Models\TelegraphChat;
use Tests\TestCase;

class YoungFolksHandlerTest extends TestCase
{
    protected $bot;
    protected $chat;
    protected $handler;

    protected function setUp(): void
    {
        $this->bot = $this->getMockBuilder(TelegraphBot::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->chat = $this->getMockBuilder(TelegraphChat::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->handler = new YoungFolksHandler($this->bot, $this->chat);
    }

    protected function tearDown(): void
    {
        unset($this->handler);
        unset($this->chat);
        unset($this->bot);
    }

    public function testStartWithEmptyChildren()
    {
        $menuItem = MenuItem::factory()->create();

        $this->chat->expects($this->once())
            ->method('getLocale')
            ->willReturn('ru');
        $this->chat->expects($this->once())
            ->method('message')
            ->with($menuItem->getTranslation('description', 'ru'))
            ->will($this->returnSelf());
        $this->chat->expects($this->once())
            ->method('send');

        $this->handler->menuItem = $menuItem;
        $this->handler->start(null);

        $this->chat->expects($this->once())
            ->method('getLocale')
            ->willReturn('lv');
        $this->chat->expects($this->once())
            ->method('message')
            ->with($menuItem->getTranslation('description', 'lv'))
            ->will($this->returnSelf());
        $this->chat->expects($this->once())
            ->method('send');

        $this->handler->start(null);
    }

    public function testStartWithChildren()
    {
        $menuItem = MenuItem::factory()->create();
        $childItems = MenuItem::factory()->withParent($menuItem)->count(3)->create();

        $this->chat->method('getLocale')->willReturnMap([
            ['ru', 0],
            ['lv', 1],
            ['ru', 2],
            ['lv', 3],
            ['ru', 4],
            ['ru', 5],
            ['lv', 6],
        ]);

        $this->chat->expects($this->exactly(7))
            ->method('message')
            ->withConsecutive(
                [$menuItem->getTranslation('description', 'ru')],
                [$menuItem->getTranslation('description', 'lv')],
                [$childItems[0]->getTranslation('description', 'ru')],
                [$childItems[0]->getTranslation('description', 'lv')],
                [$menuItem->getTranslation('description', 'ru')],
                [$menuItem->getTranslation('description', 'ru')],
                [$menuItem->getTranslation('description', 'lv')]
            )
            ->will($this->returnSelf());

        $this->chat->expects($this->exactly(7))
            ->method('keyboard')
            ->withConsecutive(
                [Keyboard::make()->buttons([
                    Button::make($childItems[0]->getTranslation('name', 'ru'))->action('/' . $childItems[0]->slug),
                    Button::make($childItems[1]->getTranslation('name', 'ru'))->action('/' . $childItems[1]->slug),
                    Button::make($childItems[2]->getTranslation('name', 'ru'))->action('/' . $childItems[2]->slug),
                    Button::make(__('Back'))->action('/' . $menuItem->slug),
                ])],
                [Keyboard::make()->buttons([
                    Button::make($childItems[0]->getTranslation('name', 'ru'))->action('/' . $childItems[0]->slug),
                    Button::make($childItems[1]->getTranslation('name', 'lv'))->action('/' . $childItems[1]->slug),
                    Button::make($childItems[2]->getTranslation('name', 'lv'))->action('/' . $childItems[2]->slug),
                    Button::make(('Back'))->action('/' . $menuItem->slug),
                ])],
                [Keyboard::make()->buttons([
                    Button::make(('Back'))->action('/' . $menuItem->slug),
                ])],
                [Keyboard::make()->buttons([
                    Button::make(('Back'))->action('/' . $menuItem->slug),
                ])],
                [Keyboard::make()->buttons([
                    Button::make($childItems[0]->getTranslation('name', 'ru'))->action('/' . $childItems[0]->slug),
                    Button::make($childItems[1]->getTranslation('name', 'ru'))->action('/' . $childItems[1]->slug),
                    Button::make($childItems[2]->getTranslation('name', 'ru'))->action('/' . $childItems[2]->slug),
                    Button::make(('Back'))->action('/' . $menuItem->slug),
                ])],
                [Keyboard::make()->buttons([
                    Button::make($childItems[0]->getTranslation('name', 'ru'))->action('/' . $childItems[0]->slug),
                    Button::make($childItems[1]->getTranslation('name', 'ru'))->action('/' . $childItems[1]->slug),
                    Button::make($childItems[2]->getTranslation('name', 'ru'))->action('/' . $childItems[2]->slug),
                    Button::make(('Back'))->action('/' . $menuItem->slug),
                ])],
                [Keyboard::make()->buttons([
                    Button::make($childItems[0]->getTranslation('name', 'ru'))->action('/' . $childItems[0]->slug),
                    Button::make($childItems[1]->getTranslation('name', 'lv'))->action('/' . $childItems[1]->slug),
                    Button::make($childItems[2]->getTranslation('name', 'lv'))->action('/' . $childItems[2]->slug),
                    Button::make(('Back'))->action('/' . $menuItem->slug),
                ])]
            )
            ->will($this->returnSelf());
        $this->chat->expects($this->exactly(7))
            ->method('send');

        $this->handler->menuItem = $menuItem;
        $this->handler->start(null);

        $this->handler->menuItem = $childItems[0];
        $this->handler->start(null);

        $this->handler->menuItem = $menuItem;
        $this->handler->start(null);

        $this->handler->menuItem = $menuItem;
        $this->handler->start(null);

        $this->handler->menuItem = $menuItem;
        $this->handler->start(null);

        $this->handler->menuItem = $menuItem;
        $this->handler->start(null);

        $this->handler->menuItem = $menuItem;
        $this->handler->start(null);
    }

    public function testStartWithNonRootMenuItem()
    {
        $menuItem = MenuItem::factory()->create();
        $childItems = MenuItem::factory()->withParent($menuItem)->count(2)->create();

        $this->chat->method('getLocale')->willReturnMap([
            ['ru', 0],
            ['lv', 1],
            ['ru', 2],
            ['lv', 3],
            ['ru', 4],
            ['ru', 5],
            ['lv', 6],
        ]);

        $this->chat->expects($this->exactly(7))
            ->method('message')
            ->withConsecutive(
                [$menuItem->getTranslation('description', 'ru')],
                [$menuItem->getTranslation('description', 'lv')],
                [$childItems[0]->getTranslation('description', 'ru')],
                [$childItems[0]->getTranslation('description', 'lv')],
                [$menuItem->getTranslation('description', 'ru')],
                [$menuItem->getTranslation('description', 'ru')],
                [$menuItem->getTranslation('description', 'lv')]
            )
            ->will($this->returnSelf());

        $this->chat->expects($this->exactly(7))
            ->method('keyboard')
            ->withConsecutive(
                [Keyboard::make()->buttons([
                    Button::make($childItems[0]->getTranslation('name', 'ru'))->action('/' . $childItems[0]->slug),
                    Button::make($childItems[1]->getTranslation('name', 'ru'))->action('/' . $childItems[1]->slug),
                    Button::make(__('Back'))->action('/' . $menuItem->slug),
                ])],
                [Keyboard::make()->buttons([
                    Button::make($childItems[0]->getTranslation('name', 'lv'))->action('/' . $childItems[0]->slug),
                    Button::make($childItems[1]->getTranslation('name', 'lv'))->action('/' . $childItems[1]->slug),
                    Button::make(__('Back'))->action('/' . $menuItem->slug),
                ])],
                [Keyboard::make()->buttons([
                    Button::make(__('Back'))->action('/' . $menuItem->slug),
                ])],
                [Keyboard::make()->buttons([
                    Button::make(__('Back'))->action('/' . $menuItem->slug),
                ])],
                [Keyboard::make()->buttons([
                    Button::make($childItems[0]->getTranslation('name', 'ru'))->action('/' . $childItems[0]->slug),
                    Button::make($childItems[1]->getTranslation('name', 'ru'))->action('/' . $childItems[1]->slug),
                    Button::make(('Back'))->action('/' . $menuItem->slug),
                ])],
                [Keyboard::make()->buttons([
                    Button::make($childItems[0]->getTranslation('name', 'ru'))->action('/' . $childItems[0]->slug),
                    Button::make($childItems[1]->getTranslation('name', 'ru'))->action('/' . $childItems[1]->slug),
                    Button::make(('Back'))->action('/' . $menuItem->slug),
                ])],
                [Keyboard::make()->buttons([
                    Button::make($childItems[0]->getTranslation('name', 'lv'))->action('/' . $childItems[0]->slug),
                    Button::make($childItems[1]->getTranslation('name', 'lv'))->action('/' . $childItems[1]->slug),
                    Button::make(__('Back'))->action('/' . $menuItem->slug),
                ])]
            )
            ->will($this->returnSelf());
        $this->chat->expects($this->exactly(7))
            ->method('send');

        $this->handler->menuItem = $menuItem;
        $this->handler->start(null);

        $this->handler->menuItem = $childItems[0];
        $this->handler->start(null);

        $this->handler->menuItem = $menuItem;
        $this->handler->start(null);

        $this->handler->menuItem = $menuItem;
        $this->handler->start(null);

        $this->handler->menuItem = $menuItem;
        $this->handler->start(null);

        $this->handler->menuItem = $menuItem;
        $this->handler->start(null);

        $this->handler->menuItem = $menuItem;
        $this->handler->start(null);
    }

    public function testStartWithNonRootMenuItemMissingTranslation()
    {
        $parentItem = MenuItem::factory()->create([
            'name' => [
                'lv' => null,
            ],
            'description' => [
                'ru' => null,
            ],
        ]);

        $childItems = MenuItem::factory()->count(2)->create([
            'name' => [
                'ru' => 'Дочерний пункт',
                'lv' => 'Bērnu izvēle',
            ],
            'description' => [
                'ru' => 'Описание дочернего пункта',
                'lv' => 'Apraksts bērnu izvēlei',
            ],
            'parent_id' => $parentItem->id,
        ]);

        $this->chat->method('getLocale')->willReturnMap([
            ['ru', 0],
            ['lv', 1],
            ['ru', 2],
            ['lv', 3],
            ['ru', 4],
            ['ru', 5],
            ['lv', 6],
        ]);

        $this->chat->expects($this->exactly(7))
            ->method('message')
            ->withConsecutive(
                [$parentItem->getTranslation('description', 'ru')],
                [$parentItem->getTranslation('description', 'lv')],
                [$childItems[0]->getTranslation('description', 'ru')],
                [$childItems[0]->getTranslation('description', 'lv')],
                [$parentItem->getTranslation('description', 'ru')],
                [$parentItem->getTranslation('description', 'ru')],
                [$parentItem->getTranslation('description', 'lv')]
            )
            ->will($this->returnSelf());

        $this->chat->expects($this->exactly(7))
            ->method('keyboard')
            ->withConsecutive(
                [Keyboard::make()->buttons([
                    Button::make($childItems[0]->getTranslation('name', 'ru'))->action('/' . $childItems[0]->slug),
                    Button::make($childItems[1]->getTranslation('name', 'ru'))->action('/' . $childItems[1]->slug),
                    Button::make(__('Back'))->action('/' . $parentItem->slug),
                ])],
                [Keyboard::make()->buttons([
                    Button::make($childItems[0]->getTranslation('name', 'lv'))->action('/' . $childItems[0]->slug),
                    Button::make($childItems[1]->getTranslation('name', 'lv'))->action('/' . $childItems[1]->slug),
                    Button::make(__('Back'))->action('/' . $parentItem->slug),
                ])],
                [Keyboard::make()->buttons([
                    Button::make(__('Back'))->action('/' . $parentItem->slug),
                ])],
                [Keyboard::make()->buttons([
                    Button::make(__('Back'))->action('/' . $parentItem->slug),
                ])],
                [Keyboard::make()->buttons([
                    Button::make($childItems[0]->getTranslation('name', 'ru'))->action('/' . $childItems[0]->slug),
                    Button::make($childItems[1]->getTranslation('name', 'ru'))->action('/' . $childItems[1]->slug),
                    Button::make(('Back'))->action('/' . $parentItem->slug),
                ])],
                [Keyboard::make()->buttons([
                    Button::make($childItems[0]->getTranslation('name', 'ru'))->action('/' . $childItems[0]->slug),
                    Button::make($childItems[1]->getTranslation('name', 'ru'))->action('/' . $childItems[1]->slug),
                    Button::make(('Back'))->action('/' . $parentItem->slug),
                ])],
                [Keyboard::make()->buttons([
                    Button::make(__('Back'))->action('/' . $parentItem->slug),
                ])]
            )
            ->will($this->returnSelf());
        $this->chat->expects($this->exactly(7))
            ->method('send');

        $this->handler->menuItem = $parentItem;
        $this->handler->start(null);

        $this->handler->menuItem = $childItems[0];
        $this->handler->start(null);

        $this->handler->menuItem = $parentItem;
        $this->handler->start(null);

        $this->handler->menuItem = $parentItem;
        $this->handler->start(null);

        $this->handler->menuItem = $parentItem;
        $this->handler->start(null);

        $this->handler->menuItem = $parentItem;
        $this->handler->start(null);

        $this->handler->menuItem = $parentItem;
        $this->handler->start(null);
    }
}
