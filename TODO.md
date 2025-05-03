# Feature improvements

Here I'm gathering a list of potential improvements I would do next.

## To Fix

- [ ] Any potential SQL injection attack opportunity when building and executing the query.
- [ ] Submitted phone numbers don't include the `+` prefix symbol when entered, although DB data containing it will show as expected.
  - [ ] Numbers should be also validated on the back-end as well.
- [ ] Clean-up leftovers files and dead unused code.

## Production-ready

- [ ] Decent coverage with unit and integration tests.
- [ ] Linters and auto-formatters.
- [ ] CI/CD automation with GH Actions for: tests, linters, branch-based and release deployment.

## Nice to have

- [ ] Icons enhancing the UIX.
- [ ] Ability to remove an inserted row.
