<?php
/**
 * Component Helper for Server-Side Component Generation
 * Provides PHP methods to generate consistent UI components
 */

namespace App\Helpers;

class ComponentHelper
{
    /**
     * Generate a statistics card
     */
    public static function statCard(array $data): string
    {
        $id = $data['id'] ?? 'stat-' . uniqid();
        $icon = $data['icon'] ?? 'icon-chart';
        $value = $data['value'] ?? '0';
        $label = $data['label'] ?? 'Label';
        $color = $data['color'] ?? 'primary';
        $badge = $data['badge'] ?? null;
        $progress = $data['progress'] ?? null;
        $decimals = $data['decimals'] ?? 0;
        
        $colorClasses = self::getColorClasses($color);
        
        $badgeHtml = $badge ? "<span class=\"badge {$colorClasses['badge']}\">{$badge}</span>" : '';
        $progressHtml = $progress ? "
            <div class=\"progress mt-2\" style=\"height: 4px;\">
                <div class=\"progress-bar {$colorClasses['progress']}\" 
                     style=\"width: {$progress}%\" 
                     data-progress-to=\"{$progress}\"></div>
            </div>
        " : '';
        
        return "
            <div class=\"stat-card surface p-4 h-100 position-relative overflow-hidden\" 
                 data-component=\"statCard\" 
                 data-card-id=\"{$id}\">
                <div class=\"position-absolute top-0 end-0 w-100 h-100\" 
                     style=\"background: linear-gradient(135deg, {$colorClasses['bg']} 0%, {$colorClasses['bgLight']} 100%);\"></div>
                <div class=\"position-relative\">
                    <div class=\"d-flex align-items-center justify-content-between mb-3\">
                        <div class=\"stat-icon {$colorClasses['icon']}\" 
                             style=\"width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center;\">
                            <svg width=\"24\" height=\"24\" fill=\"currentColor\">
                                <use href=\"#{$icon}\"></use>
                            </svg>
                        </div>
                        {$badgeHtml}
                    </div>
                    <h3 class=\"h4 fw-bold mb-1 {$colorClasses['text']}\" 
                        data-count-to=\"{$value}\" 
                        data-count-decimals=\"{$decimals}\">0</h3>
                    <p class=\"text-muted small mb-0\">{$label}</p>
                    {$progressHtml}
                </div>
            </div>
        ";
    }
    
    /**
     * Generate an action card
     */
    public static function actionCard(array $data): string
    {
        $id = $data['id'] ?? 'action-' . uniqid();
        $title = $data['title'] ?? 'Title';
        $subtitle = $data['subtitle'] ?? '';
        $icon = $data['icon'] ?? 'icon-plus';
        $color = $data['color'] ?? 'primary';
        $badge = $data['badge'] ?? null;
        $progress = $data['progress'] ?? null;
        $meta = $data['meta'] ?? null;
        $onclick = $data['onclick'] ?? null;
        
        $colorClasses = self::getColorClasses($color);
        
        $badgeHtml = $badge ? "<div class=\"text-end\"><span class=\"badge {$colorClasses['badge']}\">{$badge}</span></div>" : '';
        $progressHtml = $progress ? "
            <div class=\"progress mt-1\" style=\"height: 4px;\">
                <div class=\"progress-bar {$colorClasses['progress']}\" 
                     style=\"width: {$progress}%\" 
                     data-progress-to=\"{$progress}\"></div>
            </div>
        " : '';
        $metaHtml = $meta ? "<div class=\"d-flex justify-content-between mt-1\"><small class=\"text-muted\">{$meta}</small></div>" : '';
        $onclickAttr = $onclick ? "onclick=\"{$onclick}\"" : '';
        
        return "
            <div class=\"action-card d-block p-3 border rounded-3 position-relative overflow-hidden\" 
                 data-component=\"actionCard\" 
                 data-card-id=\"{$id}\"
                 {$onclickAttr}
                 style=\"transition: all 0.3s ease; cursor: pointer;\">
                <div class=\"position-absolute top-0 start-0 w-100 h-100\" 
                     style=\"background: linear-gradient(135deg, {$colorClasses['bg']} 0%, {$colorClasses['bgLight']} 100%);\"></div>
                <div class=\"position-relative\">
                    <div class=\"d-flex align-items-center gap-3\">
                        <div class=\"stat-icon {$colorClasses['icon']}\" 
                             style=\"width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center;\">
                            <svg width=\"20\" height=\"20\" fill=\"currentColor\">
                                <use href=\"#{$icon}\"></use>
                            </svg>
                        </div>
                        <div class=\"flex-grow-1\">
                            <div class=\"fw-semibold\">{$title}</div>
                            <div class=\"text-muted small\">{$subtitle}</div>
                            {$progressHtml}
                            {$metaHtml}
                        </div>
                        {$badgeHtml}
                    </div>
                </div>
            </div>
        ";
    }
    
    /**
     * Generate a form field
     */
    public static function formField(array $data): string
    {
        $id = $data['id'] ?? 'field-' . uniqid();
        $name = $data['name'] ?? $id;
        $label = $data['label'] ?? 'Label';
        $type = $data['type'] ?? 'text';
        $placeholder = $data['placeholder'] ?? '';
        $value = $data['value'] ?? '';
        $required = $data['required'] ?? false;
        $readonly = $data['readonly'] ?? false;
        $help = $data['help'] ?? '';
        $validation = $data['validation'] ?? '';
        $options = $data['options'] ?? [];
        
        $requiredAttr = $required ? 'required' : '';
        $readonlyAttr = $readonly ? 'readonly' : '';
        $placeholderAttr = $placeholder ? "placeholder=\"{$placeholder}\"" : '';
        $requiredLabel = $required ? ' *' : '';
        
        $inputHtml = self::generateFormInput($data);
        $helpHtml = $help ? "<div class=\"form-help\">{$help}</div>" : '';
        $validationHtml = $validation ? "<div class=\"invalid-feedback\">{$validation}</div>" : '';
        
        return "
            <div class=\"form-group mb-3\" data-component=\"formField\">
                <label for=\"{$id}\" class=\"form-label\">{$label}{$requiredLabel}</label>
                {$inputHtml}
                {$helpHtml}
                {$validationHtml}
            </div>
        ";
    }
    
    /**
     * Generate an alert
     */
    public static function alert(array $data): string
    {
        $id = $data['id'] ?? 'alert-' . uniqid();
        $type = $data['type'] ?? 'info';
        $message = $data['message'] ?? '';
        $dismissible = $data['dismissible'] ?? false;
        $icon = $data['icon'] ?? self::getAlertIcon($type);
        
        $dismissibleClass = $dismissible ? 'alert-dismissible' : '';
        $dismissibleHtml = $dismissible ? '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        ' : '';
        
        return "
            <div class=\"alert alert-{$type} {$dismissibleClass} d-flex align-items-center gap-2\" 
                 role=\"alert\" 
                 data-component=\"alert\"
                 data-alert-id=\"{$id}\">
                <span>{$icon}</span>
                <span>{$message}</span>
                {$dismissibleHtml}
            </div>
        ";
    }
    
    /**
     * Generate a modal
     */
    public static function modal(array $data): string
    {
        $id = $data['id'] ?? 'modal-' . uniqid();
        $title = $data['title'] ?? 'Modal Title';
        $content = $data['content'] ?? '';
        $size = $data['size'] ?? '';
        $footer = $data['footer'] ?? '';
        
        $sizeClass = $size ? "modal-{$size}" : '';
        $footerHtml = $footer ? "
            <div class=\"modal-footer\">
                {$footer}
            </div>
        " : '';
        
        return "
            <div class=\"modal fade\" id=\"{$id}\" tabindex=\"-1\" data-component=\"modal\">
                <div class=\"modal-dialog {$sizeClass}\">
                    <div class=\"modal-content\">
                        <div class=\"modal-header\">
                            <h5 class=\"modal-title\">{$title}</h5>
                            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
                        </div>
                        <div class=\"modal-body\">
                            {$content}
                        </div>
                        {$footerHtml}
                    </div>
                </div>
            </div>
        ";
    }
    
    /**
     * Generate a table
     */
    public static function table(array $data): string
    {
        $columns = $data['columns'] ?? [];
        $rows = $data['rows'] ?? [];
        
        $headerHtml = '';
        if (!empty($columns)) {
            $headerHtml = '
                <thead>
                    <tr>
                        ' . implode('', array_map(function($col) {
                            return "<th>{$col['label']}</th>";
                        }, $columns)) . '
                    </tr>
                </thead>
            ';
        }
        
        $bodyHtml = '';
        if (!empty($rows)) {
            $bodyHtml = '
                <tbody>
                    ' . implode('', array_map(function($row) use ($columns) {
                        $cells = array_map(function($col) use ($row) {
                            return "<td>" . ($row[$col['key']] ?? '') . "</td>";
                        }, $columns);
                        return '<tr>' . implode('', $cells) . '</tr>';
                    }, $rows)) . '
                </tbody>
            ';
        }
        
        return "
            <div class=\"table-responsive\" data-component=\"table\">
                <table class=\"table table-hover\">
                    {$headerHtml}
                    {$bodyHtml}
                </table>
            </div>
        ";
    }
    
    /**
     * Generate form input based on type
     */
    private static function generateFormInput(array $data): string
    {
        $id = $data['id'];
        $name = $data['name'];
        $type = $data['type'] ?? 'text';
        $value = $data['value'] ?? '';
        $placeholder = $data['placeholder'] ?? '';
        $required = $data['required'] ?? false;
        $readonly = $data['readonly'] ?? false;
        $options = $data['options'] ?? [];
        
        $baseAttrs = "id=\"{$id}\" name=\"{$name}\"";
        $baseAttrs .= $required ? ' required' : '';
        $baseAttrs .= $readonly ? ' readonly' : '';
        $placeholderAttr = $placeholder ? "placeholder=\"{$placeholder}\"" : '';
        
        switch ($type) {
            case 'select':
                $optionsHtml = implode('', array_map(function($opt) {
                    $selected = $opt['selected'] ?? false;
                    $selectedAttr = $selected ? 'selected' : '';
                    return "<option value=\"{$opt['value']}\" {$selectedAttr}>{$opt['text']}</option>";
                }, $options));
                return "<select class=\"form-select\" {$baseAttrs}>{$optionsHtml}</select>";
            
            case 'textarea':
                $rows = $data['rows'] ?? 3;
                return "<textarea class=\"form-control\" {$baseAttrs} rows=\"{$rows}\">{$value}</textarea>";
            
            case 'checkbox':
                $checked = $data['checked'] ?? false;
                $checkedAttr = $checked ? 'checked' : '';
                $checkboxLabel = $data['checkboxLabel'] ?? $data['label'];
                return "
                    <div class=\"form-check\">
                        <input class=\"form-check-input\" type=\"checkbox\" {$baseAttrs} {$checkedAttr}>
                        <label class=\"form-check-label\" for=\"{$id}\">
                            {$checkboxLabel}
                        </label>
                    </div>
                ";
            
            case 'radio':
                $checked = $data['checked'] ?? false;
                $checkedAttr = $checked ? 'checked' : '';
                $radioLabel = $data['radioLabel'] ?? $data['label'];
                return "
                    <div class=\"form-check\">
                        <input class=\"form-check-input\" type=\"radio\" {$baseAttrs} {$checkedAttr}>
                        <label class=\"form-check-label\" for=\"{$id}\">
                            {$radioLabel}
                        </label>
                    </div>
                ";
            
            case 'file':
                $accept = $data['accept'] ?? '';
                $multiple = $data['multiple'] ?? false;
                $acceptAttr = $accept ? "accept=\"{$accept}\"" : '';
                $multipleAttr = $multiple ? 'multiple' : '';
                return "<input type=\"file\" class=\"form-control\" {$baseAttrs} {$acceptAttr} {$multipleAttr}>";
            
            case 'password':
                return "
                    <div class=\"input-group\">
                        <input type=\"password\" class=\"form-control\" {$baseAttrs} {$placeholderAttr}>
                        <button type=\"button\" class=\"btn btn-outline-secondary password-toggle\" tabindex=\"-1\">
                            <svg class=\"icon\" width=\"16\" height=\"16\" fill=\"currentColor\">
                                <use href=\"#icon-eye\"></use>
                            </svg>
                        </button>
                    </div>
                ";
            
            default:
                return "<input type=\"{$type}\" class=\"form-control\" {$baseAttrs} {$placeholderAttr} value=\"{$value}\">";
        }
    }
    
    /**
     * Get color classes for components
     */
    private static function getColorClasses(string $color): array
    {
        $colors = [
            'primary' => [
                'bg' => 'rgba(13, 110, 253, 0.1)',
                'bgLight' => 'rgba(13, 110, 253, 0.05)',
                'icon' => 'bg-primary-subtle text-primary',
                'text' => 'text-primary',
                'badge' => 'bg-primary-subtle text-primary',
                'progress' => 'bg-primary'
            ],
            'success' => [
                'bg' => 'rgba(25, 135, 84, 0.1)',
                'bgLight' => 'rgba(25, 135, 84, 0.05)',
                'icon' => 'bg-success-subtle text-success',
                'text' => 'text-success',
                'badge' => 'bg-success-subtle text-success',
                'progress' => 'bg-success'
            ],
            'warning' => [
                'bg' => 'rgba(255, 193, 7, 0.1)',
                'bgLight' => 'rgba(255, 193, 7, 0.05)',
                'icon' => 'bg-warning-subtle text-warning',
                'text' => 'text-warning',
                'badge' => 'bg-warning-subtle text-warning',
                'progress' => 'bg-warning'
            ],
            'danger' => [
                'bg' => 'rgba(220, 53, 69, 0.1)',
                'bgLight' => 'rgba(220, 53, 69, 0.05)',
                'icon' => 'bg-danger-subtle text-danger',
                'text' => 'text-danger',
                'badge' => 'bg-danger-subtle text-danger',
                'progress' => 'bg-danger'
            ],
            'info' => [
                'bg' => 'rgba(13, 202, 240, 0.1)',
                'bgLight' => 'rgba(13, 202, 240, 0.05)',
                'icon' => 'bg-info-subtle text-info',
                'text' => 'text-info',
                'badge' => 'bg-info-subtle text-info',
                'progress' => 'bg-info'
            ]
        ];
        
        return $colors[$color] ?? $colors['primary'];
    }
    
    /**
     * Get alert icon based on type
     */
    private static function getAlertIcon(string $type): string
    {
        $icons = [
            'success' => '✅',
            'danger' => '❌',
            'warning' => '⚠️',
            'info' => 'ℹ️'
        ];
        
        return $icons[$type] ?? $icons['info'];
    }
}
