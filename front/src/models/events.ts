export type Event = {
  id: string,
  time: {
    start: Date,
    end: Date,
  },
  title?: string
  url?: string
  featured?: boolean
}

export const fetchNext = async (max?: number): Promise<Event[]> => {
  const defMax = max ?? 3

  return [
    {
      id: "1",
      time: {
        start: new Date('2024-04-13T17:00'),
        end: new Date('2024-04-13T22:00'),
      },
      title: 'Basler Stammtisch – April',
    },

    {
      id: "2",
      time: {
        start: new Date('2024-05-13T17:00'),
        end: new Date('2024-05-13T22:00'),
      },
      title: 'Basler Stammtisch – Mai',
    },

    {
      id: "3",
      time: {
        start: new Date('2024-06-13T17:00'),
        end: new Date('2024-06-13T22:00'),
      },
      title: 'Basler Stammtisch – June',
    },
    {
      id: "4",
      time: {
        start: new Date('2024-04-13T17:00'),
        end: new Date('2024-04-13T22:00'),
      },
      title: 'Basler Stammtisch – April',
    },
    {
      id: "5",
      time: {
        start: new Date('2024-04-13T17:00'),
        end: new Date('2024-04-13T22:00'),
      },
      title: 'Basler Stammtisch – April',
    }
  ].slice(0, defMax)
}

export const fetchRange = async (period: { start: Date, end: Date }): Promise<Event[]> => {
  const ptr = new Date(period.start);
  ptr.setDate(period.start.getDate() + 3);
  const d3 = new Date(ptr);


  return [
    {
      id: "1",
      time: {
        start: period.start,
        end: period.start,
      },
      title: 'Basler Stammtisch – April',
    },
    {
      id: "2",
      time: {
        start: period.start,
        end: d3,
      },
      title: 'Basler Stammtisch – Mai',
    },

    {
      id: "3",
      time: {
        start: period.start,
        end: period.end,
      },
      title: 'Basler Stammtisch',
    },
  ]
}
