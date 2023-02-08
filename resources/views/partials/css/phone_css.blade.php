<style>
    .emails.emails-input {
  max-height: inherit;
  border-radius: 0.25rem;
  background: #fff;
  border: 1px solid #c3c2cf;
  box-sizing: border-box;
  padding: 0.375rem;
  line-height: 1.5rem;
  font-size: 0.875rem;
  cursor: text;
  overflow: auto;
}

.emails.emails-input .email-chip {
  box-sizing: border-box;
  position: relative;
  display: inline-block;
  background: rgba(102, 153, 255, 0.2);
  vertical-align: top;
  border-radius: 0.25rem;
  padding-left: 0.625rem;
  padding-right: 1.5rem;
  margin: 0.125rem;
  max-width: 100%;
  overflow: hidden;
}

.emails.emails-input .email-chip .content {
  display: inline-block;
  vertical-align: top;
  max-width: 100%;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.emails.emails-input .email-chip .remove {
  text-decoration: none;
  color: inherit;
  text-align: center;
  position: absolute;
  cursor: pointer;
  width: 1rem;
  font-size: 1rem;
  user-select: none;
  -moz-user-select: none;
  -khtml-user-select: none;
  -webkit-user-select: none;
  -o-user-select: none;
}

.emails.emails-input .email-chip.invalid {
  background: #fff;
  border-bottom: 1px dashed #d92929;
  border-radius: 0;
  padding-left: 0;
  padding-right: 1rem;
}

.emails.emails-input input {
  border: 0;
  line-height: inherit;
  font-size: inherit;
  color: inherit;
  margin: 0.125rem;
}

.emails.emails-input input::placeholder,
.emails.emails-input input::-ms-input-placeholder,
.emails.emails-input input:-ms-input-placeholder {
  color: #c3c2cf;
  opacity: 1;
}

.emails.emails-input input:focus {
  outline: none;
}

</style>
