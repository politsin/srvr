#!/bin/bash
docker exec -it chatwoot_rails_1 sh -c 'RAILS_ENV=production bundle exec rails db:chatwoot_prepare'

# docker exec chatwoot_postgres_1 pg_dumpall -U postgres > dump.sql
# docker exec -i chatwoot_postgres_1 /usr/bin/psql -U postgres chatwoot < dump.sql


echo ""
echo ""
echo "Дать рута:"
echo "ALTER USER drupal WITH SUPERUSER;"
echo ""
echo "Дать права drupal на доступ и бэкап"
echo "GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO drupal"
echo "GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA public TO drupal"
