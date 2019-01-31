<!-- Seeds -->
<div class="table-responsive">
    <table class="table table-condensed table-striped table-bordered">
        <thead>
        <th>@lang('torrent.name')</th>
        <th>@lang('torrent.size')</th>
        <th>@lang('torrent.seeders')</th>
        <th>@lang('torrent.leechers')</th>
        <th>@lang('torrent.completed')</th>
        <th>@lang('torrent.uploaded')</th>
        <th>@lang('torrent.downloaded')</th>
        <th>@lang('torrent.torrent') @lang('torrent.seedtime')</th>
        <th>@lang('torrent.created_at')</th>
        </thead>
        <tbody>
        @foreach ($seeds as $p)
            <tr>
                <td>
                    <a class="view-torrent" href="{{ route('torrent', ['slug' => $p->torrent->slug, 'id' => $p->torrent_id]) }}"
                       data-toggle="tooltip" title="{{ $p->torrent->name }}">
                        {{ $p->torrent->name }}
                    </a>
                </td>
                <td>
                    <span class="badge-extra text-blue text-bold"> {{ $p->torrent->getSize() }}</span>
                </td>
                <td>
                    <span class="badge-extra text-green text-bold"> {{ $p->torrent->seeders }}</span>
                </td>
                <td>
                    <span class="badge-extra text-red text-bold"> {{ $p->torrent->leechers }}</span>
                </td>
                <td>
                    <span class="badge-extra text-orange text-bold"> {{ $p->torrent->times_completed }} @lang('common.times')</span>
                </td>
                <td>
                    <span class="badge-extra text-green text-bold"> {{ App\Helpers\StringHelper::formatBytes($p->uploaded , 2) }}</span>
                </td>
                <td>
                    <span class="badge-extra text-red text-bold"> {{ App\Helpers\StringHelper::formatBytes($p->downloaded , 2) }}</span>
                </td>
                @if ($p->seedtime < config('hitrun.seedtime'))
                    <td>
                        <span class="badge-extra text-red">{{ App\Helpers\StringHelper::timeElapsed($p->seedtime) }}</span>
                    </td>
                @else
                    <td>
                        <span class="badge-extra text-green">{{ App\Helpers\StringHelper::timeElapsed($p->seedtime) }}</span>
                    </td>
                @endif
                <td>{{ $p->hcreated_at && $p->hcreated_at != null ? $p->hcreated_at->diffForHumans() : "N/A"}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="text-center">
        {{ $seeds->links() }}
    </div>
</div>