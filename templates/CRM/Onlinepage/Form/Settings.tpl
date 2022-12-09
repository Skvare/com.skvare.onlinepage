{* HEADER *}
<div id="help">
  <p>Restrict following pages for anonymous users.</p>
  <p>For <i>Message for Access denied</i> put generic message. System will append link to login automatically.</p>
</div>
{foreach from=$elementNames item=elementName}
  <div class="crm-section">
    <div class="label">{$form.$elementName.label}</div>
    <div class="content">{$form.$elementName.html}</div>
    <div class="clear"></div>
  </div>
{/foreach}

<div class="crm-submit-buttons">
{include file="CRM/common/formButtons.tpl" location="bottom"}
</div>
