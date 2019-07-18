<?php

namespace App\Observers;

use App\Handlers\SlugTranslateHandler;
use App\Jobs\TranslateSlug;
use App\Models\Topic;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    public function saving(Topic $topic) {
    	$topic->body = clean($topic->body, 'user_topic_body');

        $topic->excerpt = make_excerpt($topic->body);
    }

    public function saved(Topic $topic) {
		// 推送任务到队列
		dispatch(new TranslateSlug($topic));
	}

	public function deleted(Topic $topic) {
    	// 在模型监听器中， 数据库操作需避免再次触发 Eloquent 事件， 以免造成联动逻辑冲突， 所以我们这里用了 DB 类进行操作
    	\DB::table('replies')->where('topic_id', $topic->id)->delete();
	}
}