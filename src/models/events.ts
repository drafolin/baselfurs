export type Event = {
  dateFrom: Date
  dateTo?: Date
  name: string
  link?: string
  featured?: boolean
}

export const fetchNext = (max?: number): Event[] => {
  const defMax = max ?? 3

  return [
    {
      dateFrom: new Date('2024-04-13T17:00'),
      dateTo: new Date('2024-04-13T22:00'),
      name: 'Basler Stammtisch – April',
      featured: true
    },

    {
      dateFrom: new Date('2024-05-13T17:00'),
      dateTo: new Date('2024-05-13T22:00'),
      name: 'Basler Stammtisch – Mai'
    },

    {
      dateFrom: new Date('2024-06-13T17:00'),
      dateTo: new Date('2024-06-13T22:00'),
      name: 'Basler Stammtisch – June',
      featured: true
    },
    {
      dateFrom: new Date('2024-04-13T17:00'),
      dateTo: new Date('2024-04-13T22:00'),
      name: 'Basler Stammtisch – April',
      featured: true
    },
    {
      dateFrom: new Date('2024-04-13T17:00'),
      dateTo: new Date('2024-04-13T22:00'),
      name: 'Basler Stammtisch – April',
      featured: true
    }
  ].slice(0, defMax)
}
