<div class="row">
    <div class="col-md-4">
        <canvas id="stats-doughnut-chart" height="300"></canvas>
    </div>
    <div class="col-md-8">
        <section class="box-body">
            <div class="row">
                @foreach($percents as $level => $item)
                    <div class="col-md-6">
                        <div class="info-box level level-{{ $level }} {{ $item['count'] === 0 ? 'level-empty' : '' }}">
                                <span class="info-box-icon">
                                    {!! log_styler()->icon($level) !!}
                                </span>

                            <div class="info-box-content">
                                <span class="info-box-text">{{ $item['name'] }}</span>
                                <span class="info-box-number">
                                        {{ $item['count'] }} entries - {!! $item['percent'] !!} %
                                    </span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: {{ $item['percent'] }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
</div>